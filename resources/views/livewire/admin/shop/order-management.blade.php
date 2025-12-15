<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Manajemen Pesanan (Orders)</h1>
   
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
    <div class="flex flex-col md:flex-row justify-between mb-6 space-y-4 md:space-y-0 md:space-x-4">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari No. Order, Nama Pelanggan..." 
               class="w-full md:w-1/3 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        
        <select wire:model.live="statusFilter" class="w-full md:w-1/4 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="all">Semua Status</option>
            @foreach ($availableStatuses as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>
    
    <div class="bg-white shadow-xl rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pelanggan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat Kirim</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">No Order</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Total </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kurir & No. Pelacakan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($orders as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                {{ $item->user->name ?? 'User Dihapus' }}
                                <p class="text-xs text-gray-400">#ID: {{ $item->user_id }}</p>
                            </td>
                            
                            <td class="px-6 py-4 max-w-xs overflow-hidden text-ellipsis">
                                <p class="font-medium text-gray-900">{{ $item->address->recipient_name ?? 'N/A' }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $item->address->address_line ?? 'Alamat tidak ditemukan' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center font-semibold">
                                {{ $item->order_number }}
                                <p class="text-xs text-gray-500">{{ $item->created_at->format('d M y') }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-right font-bold">
                                Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                            </td>
                            <td class="px-3 py-2">
                                @php
                                    $statusClass = match ($item->status) {
                                        'pending'    => 'badge bg-warning text-dark',
                                        'paid'       => 'badge bg-primary',
                                        'processing' => 'badge bg-info text-dark',
                                        'shipped'    => 'badge bg-secondary',
                                        'completed'  => 'badge bg-success',
                                        'cancelled'  => 'badge bg-danger',
                                        default      => 'badge bg-light text-dark',
                                    };
                                @endphp
                            
                                <span class="{{ $statusClass }}">
                                    {{ $availableStatuses[$item->status] ?? ucfirst($item->status) }}
                                </span>
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <p class="font-medium text-gray-800">{{ $item->courier_name ?? 'Belum Diatur' }}</p>
                                <p class="text-xs text-indigo-500">{{ $item->tracking_number ?? 'N/A' }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex space-x-2 justify-center">
                                <button wire:click="openDetailModal({{ $item->id }})" class="text-blue-600 hover:text-blue-900 transition duration-150 p-1 rounded-full hover:bg-blue-50" title="Lihat Detail">
                                    <i class="fas fa-eye w-4 h-4"></i>
                                </button>
                                <button wire:click="openEditModal({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900 transition duration-150 p-1 rounded-full hover:bg-indigo-50" title="Edit Status">
                                    <i class="fas fa-edit w-4 h-4"></i>
                                </button>
                                <button wire:click="deleteOrder({{ $item->id }})" 
                                        wire:confirm="Yakin ingin menghapus Order ini? Ini hanya disarankan untuk status 'Pending' atau 'Cancelled'."
                                        class="text-red-600 hover:text-red-900 transition duration-150 p-1 rounded-full hover:bg-red-50" title="Hapus Order">
                                    <i class="fas fa-trash-alt w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                <i class="fas fa-box-open text-4xl mb-3"></i>
                                <p>Tidak ada Pesanan yang ditemukan berdasarkan kriteria pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
    
    
    {{-- Modal edit --}}
    @if ($showEditModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
            <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 mx-4" @click.away="$wire.showEditModal = false">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Update Pesanan {{ $orderId }}</h3>
                
                <form wire:submit.prevent="updateOrder">
                    <div class="space-y-4">
                        <div>
                            <label for="currentStatus" class="block text-sm font-medium text-gray-700">Ubah Status</label>
                            <select wire:model="currentStatus" id="currentStatus" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @foreach ($availableStatuses as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('currentStatus') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="courier_name" class="block text-sm font-medium text-gray-700">Nama Kurir</label>
                            <input type="text" wire:model="courier_name" id="courier_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('courier_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="tracking_number" class="block text-sm font-medium text-gray-700">No. Pelacakan</label>
                            <input type="text" wire:model="tracking_number" id="tracking_number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('tracking_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700">Notes (Catatan Internal Admin)</label>
                            <textarea wire:model="notes" id="notes" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                            @error('notes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
        
                    <div class="mt-8 flex justify-end space-x-3">
                        <button type="button" wire:click="$set('showEditModal', false)" class="px-5 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition duration-150">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-150">
                            <i class="fas fa-sync-alt mr-1"></i> Update Pesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- Modal Detail --}}
    
    @if ($showDetailModal)
    <div class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-3xl p-6"
            @click.away="$wire.showDetailModal = false">

            <div class="col-span-2 flex items-center justify-between border-b mb-6 pb-3">
                {{-- judul & tanggal --}}
                <div class="flex items-center gap-4">
                    <h3 class="text-2xl font-bold">
                        Detail Pesanan {{ $detailOrder->order_number }}
                    </h3>
            
                    <span class="text-sm text-gray-500">
                        • {{ $detailOrder->created_at->format('d M Y H:i') }}
                    </span>
                </div>
            
                {{-- kanan status --}}
                <span
                    class="badge rounded-pill px-3 py-2
                    @if($detailOrder->status === 'pending')
                        bg-warning text-dark
                    @elseif($detailOrder->status === 'paid')
                        bg-primary
                    @elseif($detailOrder->status === 'processing')
                        bg-info text-dark
                    @elseif($detailOrder->status === 'shipped')
                        bg-secondary
                    @elseif($detailOrder->status === 'completed')
                        bg-success
                    @elseif($detailOrder->status === 'cancelled')
                        bg-danger
                    @endif
                    "
                >
                    {{ ucfirst($detailOrder->status) }}
                </span>
            </div>
            
            

            {{-- Informasi Pelanggan --}}
            <p><strong class="mt-4 text-lg">Nama:</strong> {{ $detailOrder->user->name }}</p>

            {{-- Alamat --}}
            @if ($detailOrder->address)
            <div class="mt-4">
                <div class="font-semibold text-lg mb-1">
                    Alamat Pengiriman:
                </div>
        
                <div class="text-gray-700 leading-relaxed border-b pb-4">
                    <p>{{ $detailOrder->address->recipient_name }}</p>
                    <p>{{ $detailOrder->address->phone_number }}</p>
                    <p>
                        {{ $detailOrder->address->address }}
                        {{ $detailOrder->address->city }}
                        {{ $detailOrder->address->province }}
                    </p>
                    <p>{{ $detailOrder->address->postal_code }}</p>
                </div>
            </div>
        @endif
        

            {{-- Items --}}
            @foreach ($detailOrder->orderItems as $item)
                <p><strong class="mt-4 text-lg">Produk Dibeli :</strong></p>
                <div class="text-gray-700   ">
                    <p>{{ $item->product->name }}</p>
                    <p>Jumlah : Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }} pcs</p>
                    <p><b>Harga Total :</b> Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</p>
                </div>
            @endforeach

            <div class="mt-6 text-right">
                <button
                    wire:click="$set('showDetailModal', false)"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg"
                >
                    Tutup
                </button>
            </div>
        </div>
    </div>
    @endif

                                        
    
 </div>