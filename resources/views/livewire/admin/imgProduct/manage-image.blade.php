<div>
    <!-- Judul dan Tombol Kembali ke Dashboard Gambar -->
    <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Kelola Gambar Produk</h1>
    <!-- Tombol kembali ke ProductImageDashboard -->
    <a href="{{ route('admin.imageDashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition duration-150">
    &larr; Kembali ke Dashboard Gambar
    </a>
    </div>
    
    <!-- Informasi Produk yang sedang dikelola -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <h2 class="text-xl font-semibold text-indigo-700">Produk: {{ $product->name }}</h2>
        <p class="text-sm text-gray-500">ID Produk: {{ $product->id }}</p>
    </div>
    
    <!-- Kotak Upload Gambar Baru -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Unggah Gambar Baru</h3>
        <form wire:submit.prevent="uploadImages">
            
            <!-- Input File Gambar -->
            <div class="mb-4">
                <label for="images" class="block text-sm font-medium text-gray-700">Pilih File Gambar (Maks 5 file)</label>
                <input type="file" wire:model="images" id="images" multiple 
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 
                              focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                
                @error('images') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                @error('images.*') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
            
            <!-- Input Alt Text -->
            <div class="mb-4">
                <label for="alt_text" class="block text-sm font-medium text-gray-700">Teks Alternatif (Alt Text)</label>
                <input type="text" wire:model.defer="alt_text" id="alt_text" placeholder="Deskripsi singkat gambar untuk SEO"
                       class="mt-1 block w-full border border-gray-300 rounded-lg shadow-sm p-2 
                              focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @error('alt_text') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
            </div>
    
            <!-- Preview Gambar Sementara -->
            @if ($images)
                <div class="mt-4 mb-4 flex space-x-3 overflow-x-auto p-2 border border-dashed rounded-lg">
                    @foreach ($images as $image)
                        <div class="relative w-24 h-24 flex-shrink-0">
                            <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover rounded-md" alt="Preview Gambar">
                        </div>
                    @endforeach
                </div>
            @endif
    
            <button type="submit" 
                    class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-lg shadow-md hover:bg-indigo-700 transition duration-150"
                    wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="images">Unggah & Simpan</span>
                <span wire:loading wire:target="images">Mengunggah...</span>
            </button>
        </form>
    </div>
    
    <!-- Daftar Gambar yang Sudah Ada -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h3 class="text-lg font-semibold mb-4 text-gray-800">Gambar yang Sudah Tersimpan ({{ $productImages->count() }})</h3>
    
        @if ($productImages->isEmpty())
            <p class="text-gray-500 italic">Belum ada gambar untuk produk ini. Silakan unggah di atas.</p>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                @foreach ($productImages as $image)
                    <div class="relative group bg-gray-100 rounded-lg overflow-hidden shadow-md hover:shadow-xl transition duration-300">
                        <!-- Gambar (Menggunakan image_url dari DB) -->
                        <img src="{{ Storage::url($image->image_url) }}" alt="{{ $image->alt_text ?: $product->name . ' Gambar' }}" 
                             class="w-full h-40 object-cover">
                        
                        <!-- Badge Gambar Utama (Menggunakan is_primary dari DB) -->
                        @if ($image->is_primary)
                            <span class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow">UTAMA</span>
                        @endif
    
                        <!-- Overlay Aksi -->
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <!-- Tombol Set Main -->
                            @if (!$image->is_primary)
                                <button wire:click="setMainImage({{ $image->id }})" 
                                        class="text-white bg-indigo-500 hover:bg-indigo-600 text-xs px-3 py-1 rounded-full mb-2 transition duration-150">
                                    Jadikan Utama
                                </button>
                            @endif
                            
                            <!-- Tombol Hapus -->
                            <button wire:click="confirmImageDeletion({{ $image->id }})" 
                                    class="text-white bg-red-600 hover:bg-red-700 text-xs px-3 py-1 rounded-full transition duration-150">
                                Hapus
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Modal Konfirmasi Hapus (Custom Modal) -->
    @if ($isDeleting)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
            <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-2xl">
                <div class="text-center">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Konfirmasi Hapus Gambar</h3>
                    <p class="text-gray-600 mb-6">Apakah Anda yakin ingin menghapus gambar ini?</p>
                </div>
                <div class="flex justify-around space-x-4">
                    <button wire:click="cancelImageDeletion" class="w-full px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition">Batal</button>
                    <button wire:click="deleteImage" class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">Ya, Hapus</button>
                </div>
            </div>
        </div>
    @endif
    
    
    </div>