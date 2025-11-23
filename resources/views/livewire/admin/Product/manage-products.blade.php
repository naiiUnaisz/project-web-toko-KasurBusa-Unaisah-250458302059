<div class="p-6 bg-white shadow-xl sm:rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kelola Produk</h2>
    
    <!-- Notifikasi Sukses -->
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
            <p class="font-bold">Sukses!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    <div class="flex justify-between items-center mb-4">
        <!-- Tombol Tambah Produk -->
        <button wire:click="createProduct" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 shadow-md">
            + Tambah Produk Baru
        </button>
    
        <!-- Search dan Pagination -->
        <div class="flex space-x-3 items-center">
           <select wire:model.live="perPage" class="border-gray-300 rounded-md shadow-sm text-sm">
                <option value="5">5 per halaman</option>
                <option value="10">10 per halaman</option>
                <option value="25">25 per halaman</option>
            </select>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Produk (Nama/SKU)" class="border-gray-300 rounded-md shadow-sm w-64">
        </div>
    </div>
    
    <!-- Tabel Produk -->
    <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kategori & Brand</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Varian (Size/Stok)</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $product->name }}</div>
                        <div class="text-xs text-gray-500">SKU: {{ $product->sku ?? '-' }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <p class="font-semibold">{{ $product->kategori->name ?? 'N/A' }}</p>
                        <p class="text-xs italic">({{ $product->brand->name ?? 'N/A' }})</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <p class="font-medium text-indigo-600">{{ $product->size->name ?? 'N/A' }}</p>
                        <p class="text-xs">Stok: <span class="font-semibold">{{ $product->stock_quantity }}</span></p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                        <!-- Tombol Edit -->
                        <button wire:click="editProduct({{ $product->id }})" class="text-indigo-600 hover:text-indigo-900 mr-4 transition duration-150">
                            Edit
                        </button>
                        
                        <!-- Tombol Kelola Gambar (Route tetap ada) -->
                        {{-- <a href="{{ route('admin.images', ['productId' => $product->id]) }}" 
                           class="text-blue-600 hover:text-blue-900 mr-4 transition duration-150">
                            Gambar
                        </a> --}}
    
                        <!-- Tombol Hapus -->
                        <button wire:click="deleteProduct({{ $product->id }})" 
                                 onclick="confirm('Apakah Anda yakin ingin menghapus produk ini?') || event.stopImmediatePropagation()"
                                 class="text-red-600 hover:text-red-900 transition duration-150">
                            Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500 italic">
                        Tidak ada produk ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-4">
        {{ $products->links() }}
    </div>
    
    @include('livewire.admin.Product.editProduct')
    
    
    </div>
    