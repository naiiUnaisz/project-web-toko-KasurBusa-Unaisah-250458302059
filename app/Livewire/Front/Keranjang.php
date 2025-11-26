<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;

#[Layout('layouts.keranjangCart')]
class Keranjang extends Component
{

    public $cartItems = [];
    public $subtotal = 0;
    
    #[On('keranjangDiperbarui')] 

    public function render()
    {
        return view('livewire.front.keranjang');
    }

    public function mount()
    {
        $this->loadCart();
    }

    private function loadCart()
    {
        $this->cartItems = session()->get('cart', []);
        $this->calculateTotals();
    }

    private function calculateTotals()
    {
        $this->subtotal = 0;
        foreach ($this->cartItems as $item) {
    
            $price = $item['price'] ?? 0;
            $quantity = $item['quantity'] ?? 0;
            $this->subtotal += $price * $quantity;
        }
    }

   
    public function updateQuantity($productId, $action)
    {
        if (!isset($this->cartItems[$productId])) {
            return;
        }

        if ($action === 'increase') {
            $this->cartItems[$productId]['quantity']++;
        } elseif ($action === 'decrease') {
       
            if ($this->cartItems[$productId]['quantity'] > 1) {
                $this->cartItems[$productId]['quantity']--;
            }
        }
        
        session()->put('cart', $this->cartItems);
        $this->calculateTotals();
    
        $this->dispatch('keranjangDiperbarui'); 
        session()->flash('success', 'Kuantitas berhasil diperbarui.');
    }

    public function removeItem($productId)
    {
        if (isset($this->cartItems[$productId])) {
            $productName = $this->cartItems[$productId]['name'];
            unset($this->cartItems[$productId]);
            
            session()->put('cart', $this->cartItems);
            $this->calculateTotals();
            
            $this->dispatch('keranjangDiperbarui');
            session()->flash('success', $productName . ' berhasil dihapus dari keranjang.');
        }
    }
}
