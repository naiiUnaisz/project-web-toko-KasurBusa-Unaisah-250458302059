<?php

namespace App\Livewire\Front;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;

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
}
