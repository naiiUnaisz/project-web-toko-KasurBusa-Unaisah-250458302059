<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Detail Item Pesanan (order_items)</h1>
    
    <!-- Notifikasi -->
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
        <!-- Pencarian Nama Produk -->
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari Nama Produk / ID Produk..." 
               class="w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        
        <!-- Filter Order ID -->
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
                            <!-- 1. No. Order -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                {{ $item->order->order_number ?? 'N/A' }}
                            </td>
                            
                            <!-- 2. ID Produk -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    {{ $item->produk_id }}
                                </span>
                            </td>
                            
                            <!-- 3. Nama Produk (Snapshot) -->
                            <td class="px-6 py-4 max-w-sm text-sm font-medium text-gray-900 overflow-hidden text-ellipsis">
                                {{ $item->product_name_snapshot }}
                                @if($item->product)
                                    <p class="text-xs text-green-500">Produk tersedia di katalog</p>
                                @else
                                    <p class="text-xs text-red-500">Produk sudah dihapus dari katalog</p>
                                @endif
                            </td>
    
                            <!-- 4. Kuantitas -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center font-bold">
                                {{ $item->quantity }}
                            </td>
    
                            <!-- 5. Harga Satuan -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right">
                                {{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            
                            <!-- 6. Subtotal -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-bold">
                                {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
    
                            <!-- 7. Status Order -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $status = $item->order->status ?? 'unknown';
                                    $statusClass = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'paid' => 'bg-blue-100 text-blue-800',
                                        'completed' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                            
                            <!-- 8. Aksi -->
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