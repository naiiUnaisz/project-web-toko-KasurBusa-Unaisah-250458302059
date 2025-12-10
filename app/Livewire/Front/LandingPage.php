<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Wishlist;
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


public function addWishlist($productId)
    {
        $user = Auth::user();

        if (!$user) {
            session()->flash('error', 'You must be logged in to add items to your wishlist.');
            return;
        }

        $wishlist = Wishlist::where('user_id', $user->id)
        ->where('product_id', $productId)
        ->first();

        if ($wishlist) {
            session()->flash('info', 'This item is already in your wishlist.');
        } else {
            Wishlist::create([
                'user_id' => $user->id,
                'product_id' => $productId,
            ]);
        
            session()->flash('success', 'Item added to your wishlist.');
        }
    }   
}
