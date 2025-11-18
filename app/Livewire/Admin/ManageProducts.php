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

        if ($this->isEditing) {
          
            $product = Product::findOrFail($this->productIdBeingEdited);
            $product->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'deskripsi' => $this->deskripsi,
                'kategori_id' => $this->kategori_id,
                'brand_id' => $this->brand_id,
                'foam_type_id' => $this->foam_type_id,
            ]);

            $message = 'Produk berhasil diperbarui!';

        } else{
             
           $product = Product::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'deskripsi' => $this->deskripsi,
                'kategori_id' => $this->kategori_id,
                'brand_id' => $this->brand_id,
                'foam_type_id' => $this->foam_type_id,
            ]);

            $this->productIdBeingEdited = $product->id;
            $this->isEditing = true;
            
            $message = 'Produk Utama dibuat! Silakan tambah Varian.';
        }

        session()->flash('message', $message);

        $this->closeModal();
        // $this->dispatch('notify', 'Produk Utama berhasil dibuat! Sekarang tambahkan Varian.');
    }

    // Product::create([
    //     'name' => $this->name,
    //     'slug' => $this->slug,
    //     'deskripsi' => $this->deskripsi,
    //     'kategori_id' => $this->kategori_id,
    //     'brand_id' => $this->brand_id,
    //     'foam_type_id' => $this->foam_type_id,
    // ]);



    public function editProduct($id)
    {
        $product = Product::findOrFail($id);

        $this->productIdBeingEdited = $id;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->deskripsi = $product->deskripsi;
        $this->kategori_id = $product->kategori_id;
        $this->brand_id = $product->brand_id;
        $this->foam_type_id = $product->foam_type_id;

        $this->isEditing = true;
        $this->showModal = true;
        $this->resetValidation();
    }

    public function deleteProduct($productID)
    {
        $Products = Product::find($productID);
        $Products->delete();

        session()->flash('Delete', 'Jenis busa berhasil dihapus.');
    }
}
