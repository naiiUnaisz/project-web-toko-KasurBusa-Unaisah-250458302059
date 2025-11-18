<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\JenisBusa;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]

class ManageProducts extends Component
{

    use WithPagination;
    // use WithFileUploads; 

    public $name, $slug, $deskripsi;
    public $kategori_id, $brand_id, $foam_type_id;


    public $isEditing = false;
    public $productIdBeingEdited;

    public $showModal = false;

    // Validasi Sementara
    protected $rules = [
        'name' => 'required|min:3',
        'slug' => 'required|unique:products,slug',
        'kategori_id' => 'required',
        'brand_id' => 'required',
        'foam_type_id' => 'required',
        'deskripsi' => 'nullable',
    ];

    public function render()
    {
        
        return view('livewire.admin.manage-products', [
            'products' => Product::with(['kategori', 'brand'])->latest()->paginate(10),
            'categories' => Kategori::all(),
            'brands' => Brand::all(),
            'foamTypes' => JenisBusa::all(),
        ]);

        
    }


    public function openModal()
    {
        $this->resetValidation();
        $this->reset();
        $this->showModal = true;
        $this->isEditing = false;
    }

 
    public function updatedName($value)
    {
        $this->slug = Str::slug($value);
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function saveProduct()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'slug' => $this->slug,
            'deskripsi' => $this->deskripsi,
            'kategori_id' => $this->kategori_id,
            'brand_id' => $this->brand_id,
            'foam_type_id' => $this->foam_type_id,
        ]);

        $this->closeModal();
        $this->dispatch('notify', 'Produk Utama berhasil dibuat! Sekarang tambahkan Varian.');
    }
}
