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

    // Menambahkan produk ke keranjang
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
    $this->dispatch('keranjang Diperbarui');
}


public function addWishlist($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlist = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

        if ($wishlist) {
            $wishlist->delete();
            session()->flash('info', 'item dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
        
            session()->flash('success', 'item ditambahkan ke wishlist.');
        }
    }   
}
