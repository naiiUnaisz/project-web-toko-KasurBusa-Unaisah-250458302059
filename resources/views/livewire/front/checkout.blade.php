<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
     <div class="max-w-5xl mx-auto px-4">
 
         <h4 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
             <i class="fa-solid fa-location-dot text-primary-custom mr-3"></i>
             Riwayat & Pelacakan Pesanan
         </h4>
 
         <!-- SEARCH  -->
         <div class="bg-white p-4 rounded-xl shadow mb-6">
             <div class="flex flex-col md:flex-row gap-4">
                 <input type="search"
                     wire:model.live.debounce.300ms="search"
                     placeholder="Cari pesanan riwayat pesanan..." 
                     class="w-full border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:ring-primary-500 focus:border-primary-500">
                 <button class="bg-primary-custom text-white p-2 px-3 rounded-md transition duration-150 bg-primary-custom:hover">
                     <i class="fa-solid fa-magnifying-glass"></i>
                 </button>
             </div>
 
             <!-- Tabs Status -->
             <div class="mt-4 flex flex-wrap gap-3 items-center">
                 <span class="font-semibold">Status:</span>
 
                 <button wire:click="filterStatus('all')"
                     class="px-4 py-2 rounded-full {{ $statusFilter=='all' ? 'bg-primary-custom text-white' : 'border' }}">
                     Semua
                 </button>
                 <button wire:click="filterStatus('pending')"
                 class="px-4 py-2 rounded-full {{ $statusFilter=='pending' ? 'bg-primary-custom text-white' : 'border' }}">
                 Pending
                 </button>
                <button wire:click="filterStatus('processing')"
                    class="px-4 py-2 rounded-full {{ $statusFilter=='processing' ? 'bg-primary-custom text-white' : 'border' }}">
                    Processing
                </button>
                <button wire:click="filterStatus('shipped')"
                    class="px-4 py-2 rounded-full {{ $statusFilter=='shipped' ? 'bg-primary-custom text-white' : 'border' }}">
                    Shipped
                </button>
                <button wire:click="filterStatus('completed')"
                    class="px-4 py-2 rounded-full {{ $statusFilter=='completed' ? 'bg-primary-custom text-white' : 'border' }}">
                    Completed
                </button>
                <button wire:click="filterStatus('cancelled')"
                    class="px-4 py-2 rounded-full {{ $statusFilter=='cancelled' ? 'bg-primary-custom text-white' : 'border' }}">
                    Cancelled
                </button>
             
             </div>
         </div>
 
         <!-- CARD RIWAYAT -->
         @foreach($orders as $item)
             <div class="bg-white p-5 rounded-xl shadow mb-5">
 
                 <!-- Header Card -->
                 <div class="flex items-center gap-3">
                     <i class="fa-solid fa-bag-shopping text-primary-custom text-xl"></i>
                     <span class="font-semibold">Belanja</span>
                     <span class="text-sm text-black  ml-2">{{ $item->created_at->format('d M Y') }}</span>
 
                     <span class=" text-gray-500 text-sm">
                        || {{ $item->order_number }}
                     </span>

                     <span class=" ml-auto  px-3 py-1 text-xs rounded-full font-semibold
                         {{ $item->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                         {{ $item->status == 'processing' ? 'bg-blue-100 text-blue-800' : '' }}
                         {{ $item->status == 'shipped' ? 'bg-indigo-100 text-indigo-800' : '' }}
                         {{ $item->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                         {{ $item->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                     {{ ucfirst($item->status) }}
                 </span>
                 </div>
 
                 <!-- Produk -->
                 @foreach ($item->orderItems as $i)
                 @php
            $image = optional($i->product->images)->first();
                 @endphp
                 <div class="mt-4 flex gap-4">
                    <img 
                    src="{{ $image ? asset('storage/' . $image->image_url) : 'https://via.placeholder.com/90' }}"
                    class="w-20 h-20 rounded-lg border object-cover"
                >
 
                     <div class="flex flex-col justify-between flex-grow">
                         <div>
                             <p class="font-semibold text-gray-900">
                                 {{ $i->product->name }}
                             </p>
                             <p class="text-sm text-gray-600">{{ $i->quantity }} barang × Rp{{ number_format($i->price) }}</p>
                         </div>
                     </div>
                 </div>
                 @endforeach
 
                 <div class="mt-4 text-right">
                     <p class="text-sm text-gray-500">Total Belanja</p>
                     <p class="text-primary-custom font-bold text-lg">Rp {{ number_format($item->total_amount) }}</p>
                 </div>
 
                 <!-- FOOTER -->
                 <div 
                    class="mt-4 flex justify-end gap-3">
                     <button 
                      wire:click="showDetail({{ $item->id }})"
                     class="px-4 py-2 border rounded-lg bg-primary-custom text-white hover:bg-yellow-600 ">
                         Lihat Detail Transaksi
                     </button>
 
                     <button 
                         wire:click="track({{ $item->id }})"
                         class="px-5 py-2 border rounded-lg text-primary-custom border-primary-custom hover:bg-primary-custom hover:text-black transition-button">
                         Lacak
                     </button>
                 </div>
 
             </div>
         @endforeach
 
     </div>
 
     {{-- modal lacak --}}
     @if ($showTrackingModal)
     <div class="fixed inset-0 bg-black/40 flex items-center justify-center p-4">
         <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full p-6 relative">
 
             <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-500">
                 <i class="fa fa-xmark text-xl"></i>
             </button>
 
             <h2 class="text-2xl font-bold mb-4">Lacak Pesanan</h2>
 
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 
                 <div class="space-y-2">
                     <p><span class="font-semibold">Kurir :</span>{{$trackingOrder->courier_name}}</p>
                     <p><span class="font-semibold">Nomor Resi :</span>{{$trackingOrder->order_number}}</p>
                     <p class="text-primary-custom font-bold text-lg">{{ $trackingOrder->tracking_number }}</p>
                 </div>
 
                 <!-- Timeline data dummy-->
                 <div>
                     <h3 class="font-semibold mb-3">Status Pengiriman</h3>
 
                     <div class="space-y-4 border-l-2 pl-4 relative">
                         @foreach($trackingData as $step)
                             <div class="relative">
                                 <div class="absolute -left-2 w-3 h-3 rounded-full
                                     {{ $step['done'] ? 'bg-green-500' : 'bg-gray-400' }}"></div>
 
                                 <p class="font-semibold">{{ $step['title'] }}</p>
                                 <p class="text-sm text-gray-600">{{ $step['time'] }}</p>
                             </div>
                         @endforeach
                     </div>
                 </div>
 
             </div>
 
         </div>
     </div>
     @endif

     {{-- MODAL DETAIL TRANSAKSI --}}
        @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            
            {{-- BACKDROP --}}
            <div 
                class="absolute inset-0 bg-black bg-opacity-50"
                wire:click="closeModal"
            ></div>

            {{-- CONTENT --}}
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-lg p-6 relative z-10">

                {{-- Close button --}}
                <button 
                    wire:click="closeModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
                >
                    ✕
                </button>

                <h2 class="text-xl font-bold mb-4 text-center">Detail Transaksi</h2>

                {{-- Informasi Utama --}}
                <div class="mb-4">
                    <p><strong>No. Pesanan :</strong> {{ $selectedOrder->order_number }}</p>
                    <p><strong>Tanggal Pembelian :</strong> {{ $selectedOrder->created_at->format('d M Y') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="px-2 py-1 bg-yellow-200 rounded-lg">
                            {{ $selectedOrder->status }}
                        </span>
                    </p>
                </div>

                <hr class="my-3">

                {{-- Item --}}
                <h3 class="font-semibold mb-2">Produk</h3>

                @foreach ($selectedOrder->orderItems as $item)
                <div class="flex gap-3 mb-3 border-b pb-3">
                    <img src="{{ $image ? asset('storage/' . $image->image_url) : 'https://via.placeholder.com/90' }}" 
                        class="w-16 h-16 rounded object-cover">

                    <div class="flex-1">
                        <p class="font-semibold">{{ $item->product->name }}</p>
                        <p class="text-sm text-gray-500">{{ $item->quantity }} barang × Rp{{ number_format($item->price) }}</p>
                    </div>

                    <p class="font-semibold">
                        Rp{{ number_format($item->price * $item->quantity) }}
                    </p>
                </div>

                <h3 class="font-semibold mb-2">Info Pengiriman</h3>
                <div class="flex-1 gap-3 mb-3 border-b pb-2">

                    <p class="text-sm text-gray-500">Alamat : {{ $selectedOrder->user_address_id }}</p>
                    <p class="text-sm text-gray-500">Kurir : {{$selectedOrder->courier_name}}</p>
                </div>
                    
                <h3 class="font-semibold mb-2">Rincian Pembayaran</h3>
                <div class="flex-1 gap-3 mb-3 pb-2">

                    <p class="text-sm text-gray-500">Metode Pembayaran : {{ $selectedOrder->payment->payment_method ?? '-'}}</p>
                    <p class="text-sm text-gray-500">Harga Barang : {{$selectedOrder->payment->price ?? '-'}}</p>
                    <p class="text-sm text-gray-500">Total Ongkos Kirim : {{$selectedOrder->courier_name}}</p>
                </div>
                @endforeach

                <hr class="my-3">

                {{-- Total --}}
                <div class="flex justify-between text-lg font-bold">
                    <span>Total Belanja</span>
                    <span>Rp{{ number_format($selectedOrder->total_amount) }}</span>
                </div>

                {{-- Footer --}}
                <div class="mt-6 flex justify-end">
                    <button 
                        wire:click="closeModal"
                        class="px-6 py-2 bg-primary-custom text-white rounded-lg hover:bg-red-700"
                    >
                        Tutup
                    </button>
                </div>

            </div>

        </div>
        @endif

    </main>
 </div>
 