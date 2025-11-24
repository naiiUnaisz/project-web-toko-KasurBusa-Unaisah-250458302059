<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.landingPage')]

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.front.landing-page');
    }
}
