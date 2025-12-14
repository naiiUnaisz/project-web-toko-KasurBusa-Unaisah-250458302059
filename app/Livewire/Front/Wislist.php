<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.landingPage')]
class Wislist extends Component
{

    public $wishlistId = [];

    public function mount()
    {
        
        $this->wishlistId = Wishlist::where('user_id', Auth::id())
            ->pluck('product_id')
            ->toArray();
    }

    public function render()
    {
        $items = Wishlist::where('user_id', Auth::id())
        ->with('product.size')
        ->get();

        return view('livewire.front.wislist', compact('items'));
    }


        public function deleteWishlist($productId)
    {
        Wishlist::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->delete();

            $this->wishlistId = array_filter($this->wishlistId, function($id) use ($productId) {
                return $id !== $productId;
            });

        session()->flash('success', 'Item Berhasil Dihapus dari Wishlist.');
    }

}
