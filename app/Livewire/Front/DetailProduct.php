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

#[Layout('layouts.detailProduct')]

class DetailProduct extends Component
{
    public $product;
    public $relatedProducts = [];

    public $rating = 5;
    public $reviewText = '';


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
        $product = Product::with(['images', 'primaryImage', 'Size'])->findOrFail($this->product->id);

    
        $relatedProducts = Product::with('primaryImage')
        ->where('kategori_id', $product->kategori_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

        $reviews = Review::with('user')
        ->where('product_id', $product->id)
        ->where('is_approved', 1)
        ->latest()
        ->get();

        $averageRating = $reviews->avg('rating');

        // $reviewsCount = $reviews->count();

        return view('livewire.front.detail-product', [
        'product'        => $product,
            'relatedProducts'=> $relatedProducts,
            'reviews'        => $reviews,
            'averageRating'  => $averageRating,
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
        'is_approved' => 0,  // admin perlu verifikasi dulu
        'approved_byadmin_id' => null,
    ]);

    $this->rating = 5;
    $this->reviewText = '';

    session()->flash('success', 'Ulasan berhasil dikirim! Menunggu verifikasi admin.');
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
