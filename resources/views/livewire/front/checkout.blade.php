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
                     placeholder="Cari pesanan di katalog..." 
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
                 <button wire:click="filterStatus('pending')" class="px-4 py-2 rounded-full border ">Pending</button>
                 <button wire:click="filterStatus('processing')" class="px-4 py-2 rounded-full border">Processing</button>
                 <button wire:click="filterStatus('shipped')" class="px-4 py-2 rounded-full border">Shipped</button>
                 <button wire:click="filterStatus('completed')" class="px-4 py-2 rounded-full border">Completed</button>
                 <button wire:click="filterStatus('cancelled')" class="px-4 py-2 rounded-full border">Cancelled</button>
             </div>
         </div>
 
         <!-- CARD RIWAYAT -->
         @foreach($orders as $item)
             <div class="bg-white p-5 rounded-xl shadow mb-5">
 
                 <!-- Header Card -->
                 <div class="flex items-center gap-3">
                     <i class="fa-solid fa-store text-primary-custom text-xl"></i>
                     <span class="font-semibold">Busa Cileungsi</span>
                     <span class="text-sm text-gray-500 ml-2">{{ $item->created_at->format('d M Y') }}</span>
 
                     <span class="ml-4 px-3 py-1 text-xs rounded-full font-semibold
                         @if($item->status=='pending') bg-yellow-100 text-yellow-700
                         @elseif($item->status=='completed') bg-green-100 text-green-700
                         @else bg-gray-200 text-gray-700 
                         @endif">
                         {{ ucfirst($item->status) }}
                     </span>
 
                     <span class="ml-auto text-gray-500 text-sm">
                         {{ $item->order_number }}
                     </span>
                 </div>
 
                 <!-- Produk -->
                 @foreach ($item->orderItems as $i)
                 <div class="mt-4 flex gap-4">
                     <img 
                         src="{{ $i->product->image_url ?? 'https://via.placeholder.com/90' }}"
                         class="w-20 h-20 rounded-lg object-cover border">
 
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
                 <div class="mt-4 flex justify-end gap-3">
                     <a href="#" class="px-4 py-2 border rounded-lg hover:bg-gray-100">
                         Lihat Detail Transaksi
                     </a>
 
                     <button 
                         wire:click="track({{ $item->id }})"
                         class="px-5 py-2 border rounded-lg text-primary-custom border-primary-custom hover:bg-primary-custom hover:text-white transition-button">
                         Lacak
                     </button>
                 </div>
 
             </div>
         @endforeach
 
     </div>
 
     <!-- MODAL -->
     @if ($showTrackingModal)
     <div class="fixed inset-0 bg-black/40 flex items-center justify-center p-4">
         <div class="bg-white rounded-xl shadow-xl max-w-3xl w-full p-6 relative">
 
             <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-500">
                 <i class="fa fa-xmark text-xl"></i>
             </button>
 
             <h2 class="text-2xl font-bold mb-4">Lacak Pesanan</h2>
 
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
 
                 <div class="space-y-2">
                     <p><span class="font-semibold">Kurir:</span> J&T</p>
                     <p><span class="font-semibold">Service:</span> EZ</p>
 
                     <p class="mt-3 font-semibold">Nomor Resi:</p>
                     <p class="text-primary-custom font-bold text-lg">{{ $trackingOrder->tracking_number }}</p>
                 </div>
 
                 <!-- Timeline -->
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
    </main>
 </div>
 