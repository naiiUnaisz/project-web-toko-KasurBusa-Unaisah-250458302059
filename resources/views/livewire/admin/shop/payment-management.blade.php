<div class="p-6">
    <!-- Pastikan Anda telah mengimpor Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Konfirmasi Pembayaran</h1>
    <p class="text-gray-600 mb-8">Tinjau dan setujui bukti pembayaran dari pelanggan. Ini memuat data dari tabel `payment_confirmations`.</p>
    
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
        <!-- Pencarian -->
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari No. Order, Nama Bank..." 
               class="w-full md:w-1/2 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        
        <!-- Filter Status -->
        <select wire:model.live="statusFilter" class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="all">Semua Status</option>
            {{-- Asumsi $availableStatuses ada di Livewire Component --}}
            @foreach ($availableStatuses as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
    
    <!-- Tabel Konfirmasi Pembayaran -->
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Metode Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Bank</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status Konfirmasi</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($payments as $item) 
                        <tr>
                            <!-- 1. Nomor Pesanan (Mengakses Relasi Order) -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                {{ $item->order->order_number ?? 'Order Dihapus' }} 
                                <p class="text-xs text-gray-400">Total: Rp {{ number_format($item->order->total_amount ?? 0, 0, ',', '.') }}</p>
                            </td>
                            
                            <!-- 2. Metode Pembayaran -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ ucfirst($item->payment_method) }}
                            </td>
                            
                            <!-- 3. Bukti Pembayaran -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if ($item->proof_image_url)
                                    <a href="{{ $item->proof_image_url }}" target="_blank" class="text-blue-500 hover:text-blue-700 font-semibold">
                                        Lihat Bukti <i class="fas fa-external-link-alt ml-1"></i>
                                    </a>
                                @else
                                    N/A
                                @endif
                            </td>
                            
                            <!-- 4. Nama Bank / Rekening -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ $item->bank_name ?? 'N/A' }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if ($item->status == 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                @elseif ($item->status == 'approved')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                @elseif ($item->status == 'rejected')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                @endif
                                        {{ ucfirst($item->status) }}
                                    </span>
                            </td>
                            
                            <!-- 6. Aksi -->
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2 justify-center">
                                @if ($item->status === 'pending')
                                    <button wire:click="updateStatus({{ $item->id }}, 'approved')" 
                                            wire:confirm="Setujui pembayaran ini? Status order akan diubah menjadi PAID."
                                            class="text-green-600 hover:text-green-900 transition duration-150 p-1 rounded-full hover:bg-green-50" title="Setujui Pembayaran">
                                        <i class="fas fa-check w-4 h-4"></i> Setujui
                                    </button>
                                    <button wire:click="updateStatus({{ $item->id }}, 'rejected')" 
                                            wire:confirm="Tolak pembayaran ini? Status order akan tetap PENDING."
                                            class="text-red-600 hover:text-red-900 transition duration-150 p-1 rounded-full hover:bg-red-50" title="Tolak Pembayaran">
                                        <i class="fas fa-times w-4 h-4"></i> Tolak
                                    </button>
                                @else
                                    <span class="text-gray-500 text-xs">Aksi selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                                <i class="fas fa-credit-card text-4xl mb-3"></i>
                                <p>Tidak ada Konfirmasi Pembayaran yang ditemukan.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <div class="p-4">
            {{-- Asumsi $payments di komponen Livewire --}}
            {{ $payments->links() }} 
        </div>
    </div>
    
    
    </div>