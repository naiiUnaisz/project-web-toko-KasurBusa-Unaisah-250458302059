<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.landingPage')]

class LandingPage extends Component
{
    public function render()
    {
        $products = Product::with('primaryImage')
        ->latest()
        ->take(3)
        ->get();

        return view('livewire.front.landing-page', [
        'products' => $products
    ]);
    }

    public function addToCart($productId)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $cartItem = CartItem::where('user_id', Auth::id())
                ->where('produk_id', $productId)
                ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        CartItem::create([
            'user_id'   => Auth::id(),
            'produk_id' => $productId,
            'quantity'  => 1,
        ]);
    }

    session()->flash('success', 'Produk berhasil ditambahkan ke keranjang!');
    $this->dispatch('keranjangDiperbarui');
}

}
