<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageImage extends Component
{

    use WithFileUploads;

    public $product;
    public $productId;
    public $images; 
    public $newImages = []; 
   
    // protected $listeners = ['imageAdded' => 'loadImages']; 
    
    // protected $listeners = ['imageAdded' => 'loadImages']; 

    public function render()
    {
        return view('livewire.admin.imgProduct.manage-image');
    }

   
    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::findOrFail($productId);
        $this->loadImages();
    }

   
    public function loadImages()
    {
        // kolom 'is_primary' untuk pengurutan
        $this->images = $this->product->images()->orderByDesc('is_primary')->get();
    }

    
    public function saveImages()
    {
        $this->validate([
            'newImages.*' => 'image|max:2048', 
        ], [
            'newImages.*.image' => 'File harus berupa gambar.',
            'newImages.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        if (!empty($this->newImages)) {
            // mengecek apakah produk sudah memiliki gambar
            $hasExistingImages = $this->product->images()->exists();
            
            foreach ($this->newImages as $index => $file) {
                
                $path = $file->store('products/images', 'public');
                
                $isPrimary = (!$hasExistingImages && $index === 0) ? 1 : 0; 
                
                ProductImage::create([
                    'produk_id' => $this->productId, 
                    'image_url' => $path,           
                    'is_primary' => $isPrimary,     
                    'alt_text' => 'Gambar produk ' . $this->product->name,
                ]);
            }
            
            $this->reset('newImages'); 
            $this->loadImages(); 
            session()->flash('imageMessage', 'Gambar berhasil ditambahkan!');
        } else {
            session()->flash('imageError', 'Pilih minimal satu gambar untuk diupload.');
        }
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        
        Storage::disk('public')->delete($image->image_url);

        $image->delete();

        // Jika gambar yang dihapus adalah primary, tetapkan gambar pertama yang tersisa sebagai primary
        if ($image->is_primary) {
            $newPrimary = $this->product->images()->first();
            if ($newPrimary) {
                $newPrimary->is_primary = 1;
                $newPrimary->save();
            }
        }
        
        $this->loadImages();
        session()->flash('imageMessage', 'Gambar berhasil dihapus.');
    }
    
    // Method untuk menandai gambar sebagai gambar utama (primary)
    public function setAsPrimary($imageId)
    {
    
        $this->product->images()->update(['is_primary' => 0]);
        
        $image = ProductImage::findOrFail($imageId);
        $image->is_primary = 1;
        $image->save();
        
        $this->loadImages();
        session()->flash('imageMessage', 'Gambar utama berhasil diubah.');
    }
   
}
