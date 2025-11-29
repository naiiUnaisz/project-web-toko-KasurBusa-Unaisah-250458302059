<?php

namespace App\Livewire\Front;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\JenisBusa;
use Livewire\Attributes\Layout;
use App\Models\Size;


#[Layout('layouts.landingPage')]
class Katalog extends Component
{
    public $search = '';

    // Filter
    public $brand = [];
    public $foam = [];
    public $size = [];
    public $maxPrice = 15000000;

    // Sorting
    public $sort = 'default';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Product::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if (!empty($this->brand)) {
            $query->whereIn('brand_id', $this->brand);
        }

        if (!empty($this->foam)) {
            $query->whereIn('foam_type_id', $this->foam);
        }

        if (!empty($this->size)) {
            $query->whereIn('size_id', $this->size);
        }

        $query->where('price', '<=', $this->maxPrice);

    //  sorting
    
        if ($this->sort === 'price-asc') {
            $query->orderBy('price', 'asc');
        } 
        elseif ($this->sort === 'price-desc') {
            $query->orderBy('price', 'desc');
        }

        return view('livewire.front.katalog',[
            'products' => $query->get(),
            'brands'   => Brand::all(),
            'foams'    => JenisBusa::all(),
            'sizes'    => Size::all(),
        ]);
    }
}
