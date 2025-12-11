<?php

namespace App\Livewire\Front;

use Livewire\Component;
use App\Models\Wishlist;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('layouts.landingPage')]
class Wislist extends Component
{

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

        session()->flash('success', 'Item Berhasil Dihapus dari Wishlist.');
    }



    // public function addWishlist($productId)
    // {
    //     $user = Auth::user();

    //     if (!$user) {
    //         session()->flash('error', 'login untuk menambahkan wishlist.');
    //         return;
    //     }

    //     $wishlist = Wishlist::where('user_id', $user->id)
    //     ->where('product_id', $productId)
    //     ->first();

    //     if ($wishlist) {
    //         session()->flash('info', 'item ini sudah tersedia di wishlist.');
    //     } else {
    //         Wishlist::create([
    //             'user_id' => $user->id,
    //             'product_id' => $productId,
    //         ]);
        
    //         session()->flash('success', 'item ditambahkan ke wishlist.');
    //     }
    // }   
}
