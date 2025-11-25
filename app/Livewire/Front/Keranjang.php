<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.keranjangCart')]
class Keranjang extends Component
{
    public function render()
    {
        return view('livewire.front.keranjang');
    }
}
