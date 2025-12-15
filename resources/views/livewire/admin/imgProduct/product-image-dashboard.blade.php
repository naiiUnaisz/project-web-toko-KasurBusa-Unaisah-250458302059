<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard Kelola Gambar Produk</h1>
    
    <div class="mb-4 flex justify-between items-center">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Produk berdasarkan Nama..."
               class="p-2 border border-gray-300 rounded-lg shadow-sm w-full md:w-1/3 focus:ring-indigo-500 focus:border-indigo-500">
    </div>
    
    <!-- Tabel Daftar Produk -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/12">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5/12">Nama Produk</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Jumlah Gambar</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-3/12">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                            {{ $product->images()->count() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center">
                            <button wire:click="goToManageImage({{ $product->id }})" 
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition duration-150 text-xs font-semibold">
                                Kelola Gambar
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 italic">Tidak ada produk ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    
        <!-- Pagination -->
        <div class="p-4">
            {{ $products->links() }}
        </div>
    </div>
    
    
    </div>