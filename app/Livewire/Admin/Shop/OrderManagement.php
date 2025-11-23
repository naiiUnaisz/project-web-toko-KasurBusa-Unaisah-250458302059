<?php

namespace App\Livewire\Admin\Shop;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class OrderManagement extends Component
{


    public $search = '';
    public $statusFilter = ''; 

    // Properti untuk Modal Edit
    public $showEditModal = false;
    public $orderId;

    // Properti Form Edit
    public $currentStatus;
    public $courier_name;
    public $tracking_number;
    public $notes;

    public $availableStatuses = [
        'pending' => 'Menunggu Pembayaran',
        'paid' => 'Sudah Dibayar',
        'processing' => 'Diproses',
        'shipped' => 'Dikirim',
        'completed' => 'Selesai',
        'cancelled' => 'Dibatalkan',
    ];

    // Aturan validasi saat mengedit/mengupdate
    protected $rules = [
        'currentStatus' => 'required|in:pending,paid,processing,shipped,completed,cancelled',
        'courier_name' => 'nullable|string|max:100',
        'tracking_number' => 'nullable|string|max:100',
        'notes' => 'nullable|string|max:500',
    ];

    // Method untuk membuka modal edit
    public function openEditModal($orderId)
    {
        $order = Order::findOrFail($orderId);
        $this->orderId = $orderId;
        
        // Memuat data saat ini
        $this->currentStatus = $order->status;
        $this->courier_name = $order->courier_name;
        $this->tracking_number = $order->tracking_number;
        $this->notes = $order->notes;
        
        $this->showEditModal = true;
    }

    // Method untuk menyimpan perubahan
    public function updateOrder()
    {
        $this->validate();
        
        $order = Order::findOrFail($this->orderId);
        
        $order->update([
            'status' => $this->currentStatus,
            'courier_name' => $this->courier_name,
            'tracking_number' => $this->tracking_number,
            'notes' => $this->notes,
        ]);

        $this->showEditModal = false;
        session()->flash('success', "Order #{$order->order_number} berhasil diperbarui ke status: " . $this->availableStatuses[$this->currentStatus]);
    }

    // Method untuk menghapus order
    public function deleteOrder($orderId)
    {
        // PENTING: Untuk order, biasanya hanya status CANCELLED atau PENDING yang boleh dihapus.
        // Hapus juga order_items yang terkait (Cascading delete disarankan di DB)
        $order = Order::findOrFail($orderId);
        
        if (in_array($order->status, ['pending', 'cancelled'])) {
             // Pastikan order_items dihapus juga di sini jika tidak menggunakan cascade di DB
             // $order->orderItems()->delete(); 
             $order->delete();
             session()->flash('success', "Order #{$order->order_number} berhasil dihapus.");
        } else {
             session()->flash('error', "Order #{$order->order_number} tidak dapat dihapus karena statusnya '{$order->status}'.");
        }
    }

    // Method utama untuk mendapatkan data orders
    public function getOrdersProperty()
    {
        // Query Builder untuk Order
        $query = Order::query()
                     ->with(['user', 'address']) // Asumsi ada relasi 'address' ke user_address
                     ->latest();

        // Logika Pencarian
        if ($this->search) {
            $query->where('order_number', 'like', '%' . $this->search . '%')
                  ->orWhere('total_amount', 'like', '%' . $this->search . '%')
                  ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }
        
        // Logika Filter Status
        if ($this->statusFilter && $this->statusFilter != 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Tampilkan 20 data per halaman (atau sesuai kebutuhan)
        return $query->paginate(20);
    }

    public function render()
    {
        return view('livewire.admin.shop.order-management', [
            'orders' => $this->getOrdersProperty(),
        ]);
    }
}
