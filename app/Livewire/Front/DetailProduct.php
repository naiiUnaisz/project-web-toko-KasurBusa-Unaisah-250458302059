<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.detailProduct')]

class DetailProduct extends Component
{
    public $product;
    public $relatedProducts = [];


    public function mount(Product $product)
    {
        $this->product = $product;

        $this->relatedProducts = Product::where('kategori_id', $product->kategori_id)
            ->where('id', '!=', $product->id) 
            ->take(4) 
            ->with('primaryImage')
            ->get();
    }

    public function render()
    {
        $product = Product::with(['images', 'primaryImage'])->findOrFail($this->product->id);

    
    $relatedProducts = Product::with('primaryImage')
        ->where('kategori_id', $product->kategori_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('livewire.front.detail-product', [
        'product' => $product,
        'relatedProducts' => $relatedProducts
    ]);
    }


    public function addToCart($produkId = null)
{
    if (!Auth::check()) {
        return redirect()->guest('login');
    }

    $idProduk = $produkId ?? $this->product->id;

    $cartItem = CartItem::where('user_id', Auth::id())
                ->where('produk_id', $idProduk)
                ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
        return;
    }

    CartItem::create([
        'user_id' => Auth::id(),
        'produk_id' => $idProduk,
        'quantity' => 1
    ]);
}
}
