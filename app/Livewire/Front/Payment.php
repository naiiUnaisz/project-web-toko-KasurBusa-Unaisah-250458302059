<?php

namespace App\Livewire\Front;

use id;
use App\Models\Order;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\AlamatUser;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment as PaymentModel;

#[Layout('layouts.PaymentCart')]

class Payment extends Component
{
    use WithFileUploads;

//   PROPERTI ALAMAT PENGIRIMAN
    public $recipientName;
    public $recipientPhone;
    public $deliveryAddress;

    public $selectedAddressId;
    public $addresses = [];

    // Modal alamat
    public $isModalOpen = false;          
    public $showAddressModal = false;     
    public $isEditing = false;            
    public $editAddressId;
    public $userAddresses;
    
    // Form alamat
    public $address_label;
    public $recipient_name;
    public $phone_number;
    public $address_line;
    public $city;
    public $province;
    public $postal_code;


    // properti pilihan
    public $shippingMethod = 'store_courier'; 
    public $paymentMethod = 'transfer';  
    
    // upload bukti bayar
    public $paymentProof; 
    
    // -payment confirmation
    public $bankName = 'BCA'; 
    public $accountName; 

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

        $this->addresses = AlamatUser::where('user_id', Auth::id())->get();

        // ambil default address
        $default = collect($this->addresses) 
        ->where('is_default', 1) 
        ->first();

        if ($default) {
            $this->applyAddress($default->id);
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
        

        if (!$this->selectedAddressId) {
            session()->flash('error', 'Silakan pilih alamat pengiriman.');
            return;
        }
    

        $this->calculateTotals();

        $validationRules = [
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
            'user_id'        => Auth::id(),
            'user_address_id' => $this->selectedAddressId,
            'order_number'   => 'INV-' . time(),
            'total_amount'   => $this->orderTotal, 
            'status'         => 'pending',
            'courier_name'   => $this->shippingMethod, 
            'tracking_number' => null,
            'notes'           => null,
        ]);
        

        foreach ($this->cartItems as $cartItem) {
             OrderItem::create([
                 'order_id' => $order->id,
                 'produk_id' => $cartItem->produk_id,
                 'quantity' => $cartItem->quantity,
                 'price' => $cartItem->product->price ?? 0,
                 'product_name_snapshot' => $cartItem-> product->name ?? 'unknown', 
             ]);
        }

    //   payment proof
        if (in_array($this->paymentMethod, ['transfer', 'QRIS'])) {
            $proofPath = $this->paymentProof->store('proofs', 'public'); 

           
            PaymentModel::create([ 
                'order_id' => $order->id,
                'proof_image_url' => $proofPath,
                'payment_method' => $this->paymentMethod,
                'bank_name' => $this->bankName ?: 'BCA', 
                'account_name' => $this->accountName, 
                'status' => 'pending', 
            ]);
        }
        
        // hapus data keranjang setelah checkout
        CartItem::where('user_id', $order->user_id)->delete();

        
        session()->flash('success', 'Pesanan berhasil dibuat. Kami sedang menunggu konfirmasi pembayaran Anda.');
        return redirect()->route('User.Checkout', ['order_id' => $order->id]); 
    }


    public function openModal()
    {
        $this->resetAddressForm();
        $this->isEditing = false;
    
        // Ambil semua alamat user
        $this->userAddresses = AlamatUser::where('user_id', Auth::id())->get();
    
        if ($this->userAddresses->count() == 0) {
           
            $this->isModalOpen = true;
            $this->showAddressModal = false;
        } else {

            $this->showAddressModal = true;
            $this->isModalOpen = false;
        }
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function openAddressModal()
{
    $this->isEditing = false;
    $this->showAddressModal = true;
}

public function closeAddressModal()
{
    $this->showAddressModal = false;
}


    public function resetAddressForm()
    {
        $this->address_label = '';
        $this->recipient_name = '';
        $this->phone_number = '';
        $this->address_line = '';
        $this->city = '';
        $this->province = '';
        $this->postal_code = '';
    }

    
    public function saveAddress()
    {
        $this->validate([
            'address_label' => 'required',
            'recipient_name' => 'required',
            'phone_number' => 'required',
            'address_line' => 'required',
            'city' => 'required',
            'province' => 'required',
            'postal_code' => 'required'
        ]);

        if ($this->isEditing) {
            // update alamat
            AlamatUser::where('id', $this->editAddressId)->update([
                'address_label' => $this->address_label,
                'recipient_name' => $this->recipient_name,
                'phone_number' => $this->phone_number,
                'address_line' => $this->address_line,
                'city' => $this->city,
                'province' => $this->province,
                'postal_code' => $this->postal_code,
            ]);
        } else {
            // alamat baru
            AlamatUser::create([
                'user_id' => Auth::id(),
                'address_label' => $this->address_label,
                'recipient_name' => $this->recipient_name,
                'phone_number' => $this->phone_number,
                'address_line' => $this->address_line,
                'city' => $this->city,
                'province' => $this->province,
                'postal_code' => $this->postal_code,
                'is_default' => 0
            ]);
        }

        $this->addresses = AlamatUser::where('user_id', Auth::id())->get();
        $this->isModalOpen = false;
    }


    public function editAddress($id)
    {
        $addr = AlamatUser::find($id);
        if (!$addr) return;

        $this->editAddressId = $id;
        $this->isEditing = true;

        $this->address_label = $addr->address_label;
        $this->recipient_name = $addr->recipient_name;
        $this->phone_number = $addr->phone_number;
        $this->address_line = $addr->address_line;
        $this->city = $addr->city;
        $this->province = $addr->province;
        $this->postal_code = $addr->postal_code;

        $this->isModalOpen = true;
        $this->showAddressModal = false;
    }

   
    public function deleteAddress($id)
    {
        $addr = AlamatUser::find($id);
        if (!$addr) return;

        $addr->delete();
        $this->addresses = AlamatUser::where('user_id', Auth::id())->get();

        if ($this->selectedAddressId == $id) {
            $this->selectedAddressId = null;
            $this->recipientName = null;
            $this->recipientPhone = null;
            $this->deliveryAddress = null;
        }
    }

    
    public function applyAddress($id)
    {
        $addr = AlamatUser::find($id);
        if (!$addr) return;

        $this->selectedAddressId = $id;
        $this->recipientName = $addr->recipient_name;
        $this->recipientPhone = $addr->phone_number;

        $this->deliveryAddress =
            $addr->address_label . " — " .
            $addr->address_line . ", " .
            $addr->city . ", " .
            $addr->province . ", " .
            $addr->postal_code;

        $this->showAddressModal = false;
    }

        public function openAddAddressForm()
    {
        $this->resetAddressForm();
        $this->isEditing = false;

        $this->showAddressModal = false;
        $this->isModalOpen = true;
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


