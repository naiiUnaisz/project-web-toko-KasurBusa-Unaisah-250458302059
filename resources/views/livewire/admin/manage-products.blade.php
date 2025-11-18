<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Kelola Produk</h2>
            <button wire:click="openModal" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                + Tambah Produk Baru
            </button>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="px-6 py-3 text-gray-600 font-bold uppercase text-sm">Nama Produk</th>
                        <th class="px-6 py-3 text-gray-600 font-bold uppercase text-sm">Kategori</th>
                        <th class="px-6 py-3 text-gray-600 font-bold uppercase text-sm">Brand</th>
                        <th class="px-6 py-3 text-gray-600 font-bold uppercase text-sm">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ $product->kategori->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $product->brand->name ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="editProduct({{ $product->id }})" class="text-blue-600 hover:underline">Edit</button>
                                <button 
                                    wire:click="deleteProduct({{ $product->id }})" 
                                    wire:confirm="Yakin ingin menghapus produk {{ $product->name }}? Semua varian dan gambar akan ikut terhapus!"
                                    class="text-red-600 hover:underline ml-2">
                                    Hapus
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-4">
                {{ $products->links() }}
            </div>
        </div>

        @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-2xl">
                <h3 class="text-lg font-bold mb-4">
                    {{ $isEditing ? 'Edit Produk' : 'Tambah Produk Utama' }}
                </h3>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Nama Produk</label>
                    <input type="text" wire:model.live="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Slug (URL)</label>
                    <input type="text" wire:model="slug" class="mt-1 block w-full bg-gray-100 border-gray-300 rounded-md shadow-sm" readonly>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select wire:model="kategori_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih...</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('kategori_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Merek</label>
                        <select wire:model="brand_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih...</option>

                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>
                         @error('brand_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Jenis Busa</label>
                        <select wire:model="foam_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="">Pilih...</option>

                            @foreach($foamTypes as $foam)
                                <option value="{{ $foam->id }}">{{ $foam->name }}</option>
                            @endforeach
                        </select>
                         @error('foam_type_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea wire:model="deskripsi" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>

                <div class="flex justify-end space-x-2 mt-6">
                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded-md text-gray-700">Batal</button>
                    <button wire:click="saveProduct" class="px-4 py-2 bg-indigo-600 text-white rounded-md">
                        Simpan & Lanjut
                    </button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
