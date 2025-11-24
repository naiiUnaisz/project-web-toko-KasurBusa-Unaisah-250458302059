<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Detail Item Pesanan </h1>
    
    @if (session()->has('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Filter dan Pencarian -->
    <div class="flex flex-col md:flex-row justify-between mb-6 space-y-4 md:space-y-0 md:space-x-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Nama Produk / ID Produk..." 
               class="w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        <input type="number" wire:model.live.debounce.300ms="orderIdFilter" placeholder="Filter berdasarkan Order ID..." 
               class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>
    
    <!-- Tabel Order Items -->
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Produk</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Produk</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Kuantitas</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Satuan (Rp)</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal (Rp)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Order</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                {{ $item->order->order_number ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $item->produk_id }}
                                </span>
                            </td>
                            <td class="px-6 py-4 max-w-sm text-sm font-medium text-gray-900 overflow-hidden text-ellipsis">
                                {{ $item->product_name_snapshot }}
                                @if($item->product)
                                    <p class="text-xs text-green-500">Produk tersedia di katalog</p>
                                @else
                                    <p class="text-xs text-red-500">Produk sudah dihapus dari katalog</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center font-bold">
                                {{ $item->quantity }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-bold">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if (($item->order->status ?? 'unknown') === 'pending')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        {{ ucfirst($item->order->status ?? 'unknown') }}
                                    </span>
                                @elseif (($item->order->status ?? 'unknown') === 'paid')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ ucfirst($item->order->status ?? 'unknown') }}
                                    </span>
                                @elseif (($item->order->status ?? 'unknown') === 'completed')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ ucfirst($item->order->status ?? 'unknown') }}
                                    </span>
                                @elseif (($item->order->status ?? 'unknown') === 'cancelled')
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        {{ ucfirst($item->order->status ?? 'unknown') }}
                                    </span>
                                @else
                                    <!-- Untuk status 'unknown' atau status lain yang belum didefinisikan -->
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ ucfirst($item->order->status ?? 'unknown') }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="deleteItem({{ $item->id }})" 
                                        wire:confirm="Yakin ingin menghapus item ini? HANYA lakukan jika Order Pending/Cancelled."
                                        class="text-red-600 hover:text-red-900 transition duration-150 p-1 rounded-full hover:bg-red-50" title="Hapus Item">
                                    <i class="fas fa-trash-alt w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">
                                <i class="fas fa-search-minus text-4xl mb-3"></i>
                                <p>Tidak ada Item Pesanan yang ditemukan berdasarkan kriteria pencarian/filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <div class="p-4">
            {{ $items->links() }}
        </div>
    </div>
    
    
    </div>