<?php

namespace App\Livewire\Front;

use App\Models\Size;
use App\Models\Review;
use App\Models\Product;
use Livewire\Component;
use App\Models\CartItem;
use App\Models\Wishlist;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.LandingPage')]

class DetailProduct extends Component
{
    public $product;
    public $relatedProducts = [];

    public $rating = 5;
    public $reviewText = '';
    public $tab = 'description';
    public $quantity;

    public $wishlistId = [];


    public function mount(Product $product)
    {
        $this->product = $product;
        $this->quantity = 1;

        $this->relatedProducts = Product::where('kategori_id', $product->kategori_id)
            ->where('id', '!=', $product->id) 
            ->take(4) 
            ->with('primaryImage')
            ->get();

            $this->wishlistId = Wishlist::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();
    }

    public function render()
    {
        $product = $this->product->load(['images', 'primaryImage', 'size']);

        $relatedProducts = $this->relatedProducts;

        $reviews = Review::with('user')
        ->where('product_id', $product->id)
        ->where('is_approved', 1)
        ->latest()
        ->get();

        $averageRating = $reviews->avg('rating');

        $items = Wishlist::where('user_id', Auth::id())
        ->with('product.size')
        ->get();

        return view('livewire.front.detail-product', [
        'product'        => $product,
            'relatedProducts'=> $relatedProducts,
            'reviews'        => $reviews,
            'averageRating'  => $averageRating,
            'items'          => $items,
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

    public function maxQty()
    {
        if ($this->quantity < $this->product->stock_quantity) {
            $this->quantity++;
        }
    }

    public function minQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

public function submitReview()
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $this->validate([
        'rating'     => 'required|integer|min:1|max:5',
        'reviewText' => 'required|string|min:5',
    ]);

    Review::create([
        'user_id'   => Auth::id(),
        'product_id'=> $this->product->id,
        'rating'    => $this->rating,
        'comment'   => $this->reviewText,
        'is_approved' => 0,  
        'approved_byadmin_id' => null,
    ]);

    $this->rating = 5;
    $this->reviewText = '';

    session()->flash('success', 'Ulasan berhasil dikirim! Menunggu verifikasi admin.');
}

public function setTab($tab)
{
    $this->tab = $tab;
}


public function addWishlist($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $wishlistId = Wishlist::where('user_id', Auth::id())
        ->where('product_id', $productId)
        ->first();

        if ($wishlistId) {
   
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();

            session()->flash('info', 'item dihapus dari wishlist.');
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
            ]);
        
            session()->flash('success', 'item ditambahkan ke wishlist.');
        }

         // Refresh list supaya icon berubah
         $this->wishlistId = Wishlist::where('user_id', Auth::id())
        ->pluck('product_id')
        ->toArray();
    }   

}
