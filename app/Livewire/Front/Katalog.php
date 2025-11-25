<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.Katalog')]
class Katalog extends Component
{
    public function render()
    {
        return view('livewire.front.katalog');
    }
}
