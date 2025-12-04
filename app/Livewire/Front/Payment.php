<?php

namespace App\Livewire\Front;

use id;
use App\Models\Order;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Payment as PaymentModel;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.PaymentCart')]

class Payment extends Component
{
    use WithFileUploads;

    // properti alamat
    public $recipientName;
    public $recipientPhone;
    public $deliveryAddress;

    // properti pilihan
    public $shippingMethod = 'store_courier'; 
    public $paymentMethod = 'transfer';  
    
    // upload bukti bayar
    public $paymentProof; 
    
    // -payment confirmation
    public $bankName = 'BCA'; 
    public $accountName = 'PT Kasur Busa Jaya'; 

    // properti keuangan
    public $baseTotal = 0;
    public $regularShippingCost = 75000; 
    

    public $shippingCost = 0;
    public $orderTotal;

    // data keranjang
    public $cartItems = [];

    public function mount()
    {
        
        if (!Auth::check()) {
            return redirect()->route('login'); 
        }
        
        $this->loadCartData();

        $this->calculateTotals();
    }

    protected function loadCartData()
    {
        $userId = Auth::id();
        
        $items = CartItem::with('product')
                           ->where('user_id', $userId)
                           ->get();

        if ($items->isEmpty()) {
            session()->flash('warning', 'Keranjang Anda kosong. Silakan tambahkan produk terlebih dahulu.');

            return redirect('/'); 
        }

        $newBaseTotal = 0;
        
        foreach ($items as $item) {

            $price = $item->product->price ?? 0;
            $newBaseTotal += ($price * $item->quantity);
        }

        $this->cartItems = $items;
        $this->baseTotal = $newBaseTotal; 
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['shippingMethod'])) {
            $this->calculateTotals();
        }

        if ($propertyName === 'paymentProof' && in_array($this->paymentMethod, ['transfer', 'QRIS'])) {
            $this->validateOnly($propertyName, [
                'paymentProof' => 'required|image|max:1024', 
            ]);
        }
        
        // jika COD >5 juta maka dialihkan ke transfer
        if ($propertyName === 'paymentMethod' && $this->paymentMethod === 'cod') {
            if (isset($this->orderTotal) && $this->orderTotal > 5000000) {
                session()->flash('warning', 'COD tidak berlaku untuk total di atas Rp 5 Juta. Otomatis dialihkan ke Transfer.');
                $this->paymentMethod = 'transfer'; 
            }
        }
    }

    public function calculateTotals()
    {
        $this->shippingCost = ($this->shippingMethod === 'regular') ? $this->regularShippingCost : 0;
        $this->orderTotal = $this->baseTotal + $this->shippingCost;
    }


    public function placeOrder()
    {

        if ($this->baseTotal <= 0) {
            session()->flash('error', 'Tidak ada item di keranjang. Transaksi dibatalkan.');
            return redirect('/');
        }
        
        $this->calculateTotals();

        $validationRules = [
            'recipientName' => 'required|string|max:255',
            'recipientPhone' => 'required|string|max:20',
            'deliveryAddress' => 'required|string|min:10',
            'shippingMethod' => 'required|in:store_courier,regular',
            'paymentMethod' => 'required|in:transfer,QRIS,cod', 
        ];

        if (in_array($this->paymentMethod, ['transfer', 'QRIS'])) {
            $validationRules['paymentProof'] = 'required|image|max:1024';
        }

        $this->validate($validationRules, [
            'required' => ':attribute wajib diisi.',
            'paymentProof.required' => 'Bukti pembayaran wajib diunggah.',
            'paymentProof.image' => 'File harus berupa gambar.',
        ]);
        
        if ($this->paymentMethod === 'cod' && $this->orderTotal > 5000000) {
             session()->flash('error', 'Limit COD terlampaui. Pilih Transfer atau QRIS.');
             return; 
        }

        
        $order = Order::create([
            'user_id' => Auth::id(), 
            'order_number' => 'INV-' . time(), 
            'recipient_name' => $this->recipientName,
            'recipient_phone' => $this->recipientPhone,
            'delivery_address' => $this->deliveryAddress,
            'shipping_method' => $this->shippingMethod,
            'base_total' => $this->baseTotal,
            'shipping_cost' => $this->shippingCost,
            'order_total' => $this->orderTotal,
            'payment_method' => $this->paymentMethod, 
            'status' => ($this->paymentMethod === 'cod') ? 'Order Placed (COD)' : 'Waiting for Confirmation',
        ]);
        
        
        foreach ($this->cartItems as $cartItem) {
             OrderItem::create([
                 'order_id' => $order->id,
                 'product_id' => $cartItem->product_id,
                 'quantity' => $cartItem->quantity,

                 'price_at_checkout' => $cartItem->product->price ?? 0, 
             ]);
        }

        // simpan payment confirmation COD
        if (in_array($this->paymentMethod, ['transfer', 'QRIS'])) {
            $proofPath = $this->paymentProof->store('proofs', 'public'); 

           
            PaymentModel::create([ 
                'order_id' => $order->id,
                'proof_image_url' => $proofPath,
                'payment_method' => $this->paymentMethod,
                'bank_name' => $this->bankName, 
                'account_name' => $this->accountName, 
                'status' => 'pending', 
            ]);
        }
        
        // hapus data keranjang setelah checkout
        CartItem::where('user_id', $order->user_id)->delete();

        
        session()->flash('success', 'Pesanan berhasil dibuat. Kami sedang menunggu konfirmasi pembayaran Anda.');
        return redirect()->route('order.status', ['order_id' => $order->id]); 
    }
    
    
    public function render()
    {

        $this->calculateTotals(); 
        
        if ($this->orderTotal > 5000000 && $this->paymentMethod === 'cod') {
             $this->paymentMethod = 'transfer';
        }

        return view('livewire.front.payment');
    }
}
