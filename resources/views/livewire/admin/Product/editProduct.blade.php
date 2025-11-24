@if($showModal)
<div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center z-50">
    <div class="relative bg-white rounded-lg shadow-xl w-full max-w-3xl p-6" @click.away="$wire.showModal = false">
        <h3 class="text-xl font-semibold text-gray-900 mb-4">
            {{ $isEditing ? 'Edit Produk: ' . $name : 'Tambah Produk Baru' }}
        </h3>
        
        <!-- Tombol Tutup -->
        <button type="button" wire:click="$set('showModal', false)" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <form wire:submit.prevent="{{ $isEditing ? 'updateProduct' : 'storeProduct' }}">
            
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <h4 class="text-lg font-medium text-gray-700 border-b pb-2 mb-3">Data Produk Utama</h4>
                    
                    <div class="mb-3">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
                        <input id="name" type="text" wire:model.live="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: Kasur Busa Royal King">
                        
                        @error('name')
                            <x-input-error :messages="[$message]" class="mt-2" />
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug (Otomatis)</label>
                        <input id="slug" type="text" wire:model.defer="slug" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>

                        @error('slug')
                            <x-input-error :messages="[$message]" class="mt-2" />
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="deskripsi" wire:model.defer="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>

                        @error('deskripsi')
                            <x-input-error :messages="[$message]" class="mt-2" />
                        @enderror
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-medium text-gray-700 border-b pb-2 mb-3">Kategori & Varian Spesifik</h4>

                    <div class="grid grid-cols-2 gap-3 mb-3">
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                            <select id="kategori_id" wire:model.defer="kategori_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Pilih Kategori...</option>
                                @foreach($categories as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>

                            @error('kategori_id')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                        <div>
                            <label for="brand_id" class="block text-sm font-medium text-gray-700">Brand</label>
                            <select id="brand_id" wire:model.defer="brand_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Pilih Brand...</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>

                            @error('brand_id')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="foam_type_id" class="block text-sm font-medium text-gray-700">Jenis Busa</label>
                        <select id="foam_type_id" wire:model.defer="foam_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih Jenis Busa...</option>
                            @foreach($foam_types as $foamType)
                                <option value="{{ $foamType->id }}">{{ $foamType->name }}</option>
                            @endforeach
                        </select>

                        @error('foam_type_id')
                            <x-input-error :messages="[$message]" class="mt-2" />
                        @enderror
                    </div>

                    <h4 class="text-lg font-medium text-gray-700 border-b border-t pt-3 pb-2 mb-3 mt-4">Data Varian (Spesifik)</h4>

                    <div class="grid grid-cols-2 gap-3 mb-3">
                         <div>
                            <label for="size_id" class="block text-sm font-medium text-gray-700">Ukuran</label>
                            <select id="size_id" wire:model.defer="size_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Pilih Ukuran...</option>
                                @foreach($sizes as $size)
                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                @endforeach
                            </select>

                            @error('size_id')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                        
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <input id="price" type="number" wire:model.defer="price" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Harga Jual" min="0">
                            
                            @error('price')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Stok</label>
                            <input id="stock_quantity" type="number" wire:model.defer="stock_quantity" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Jumlah Stok" min="0">

                            @error('stock_quantity')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                        <div>
                            <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                            <input id="sku" type="text" wire:model.defer="sku" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Contoh: ROYAL-K-200">
                            
                            @error('sku')
                                <x-input-error :messages="[$message]" class="mt-2" />
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3 border-t pt-4">
                <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition duration-150">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-150">
                    {{ $isEditing ? 'Simpan Perubahan' : 'Simpan Produk' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endif