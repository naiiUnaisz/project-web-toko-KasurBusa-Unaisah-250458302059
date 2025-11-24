<div class="p-6">
    <link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Ulasan Produk</h1>
    
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
        <!-- Pencarian -->
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari komentar atau ID Produk..." 
               class="w-full md:w-1/2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        
        <!-- Filter Status (approved/pending) -->
        <select wire:model.live="statusFilter" class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="all">Semua Status</option>
            <option value="pending">Menunggu (is_approved=false)</option>
            <option value="approved">Disetujui (is_approved=true)</option>
        </select>
    
        <!-- Filter Rating Bintang -->
        <select wire:model.live="starFilter" class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="all">Semua Bintang</option>
            @for ($i = 5; $i >= 1; $i--)
                <option value="{{ $i }}">{{ $i }} Bintang</option>
            @endfor
        </select>
    </div>
    
    <!-- Tabel Ulasan -->
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengulas </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk </th> 
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Item Pesanan </th>
                        
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar & Rating</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Disetujui (is_approved)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Admin ID (approved_byadmin_id)</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($reviews as $review) 
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium text-gray-900">{{ $review->user->name ?? 'Anonim' }}</span>
                                <p class="text-xs text-gray-500">ID: {{ $review->user_id }}</p>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium text-sm text-gray-800">{{ $review->product->name ?? 'Produk Dihapus' }}</span>
                                <p class="text-xs text-gray-500">ID: {{ $review->product_id }}</p>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                {{ $review->order_item_id }}
                            </td>

                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-sm text-gray-800 italic truncate">{{ $review->comment }}</p> 
                                <div class="flex items-center mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star w-4 h-4 mr-0.5 
                                            @if ($i <= $review->rating) 
                                                text-yellow-400 
                                            @else 
                                                text-gray-300 
                                            @endif
                                        "></i>
                                    @endfor
                                    <span class="text-xs text-gray-500 ml-2">({{ $review->rating }}/5)</span>
                                </div>
                            </td>
                            
                            <!-- Status Moderasi  -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($review->is_approved)
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        TRUE
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        FALSE
                                    </span>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-700">
                                {{ $review->approved_byadmin_id ?? '-' }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2 justify-center">
                                @if (!$review->is_approved)
                                    <button wire:click="updateStatus({{ $review->id }}, true)" 
                                            wire:confirm="Setujui ulasan ini?"
                                            class="text-green-600 hover:text-green-900 transition duration-150 p-1 rounded-full hover:bg-green-50" title="Setujui (TRUE)">
                                        <i class="fas fa-check w-4 h-4"></i>
                                    </button>
                                @endif
    
                                @if ($review->is_approved)
                                    <button wire:click="updateStatus({{ $review->id }}, false)" 
                                            wire:confirm="Batalkan persetujuan ulasan ini?"
                                            class="text-red-600 hover:text-red-900 transition duration-150 p-1 rounded-full hover:bg-red-50" title="Tolak (FALSE)">
                                        <i class="fas fa-times w-4 h-4"></i>
                                    </button>
                                @endif
    
                                <button wire:click="deleteReview({{ $review->id }})" 
                                        wire:confirm="Yakin ingin menghapus ulasan ini secara permanen?"
                                        class="text-gray-600 hover:text-gray-900 transition duration-150 p-1 rounded-full hover:bg-gray-50" title="Hapus Permanen">
                                    <i class="fas fa-trash-alt w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <i class="fas fa-comment-dots text-4xl mb-3"></i>
                                <p>Tidak ada Ulasan Produk yang ditemukan dengan kriteria ini.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <div class="p-4">
            {{ $reviews->links() }} 
        </div>
    </div>
    
    
    </div>