<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.PaymentCart')]

class Payment extends Component
{
    public function render()
    {
        return view('livewire.front.payment');
    }
}
