
<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <h2 class="text-3xl  font-semibold text-gray-900 mb-8 border-b pb-4">
            <i class="fa-solid fa-cart-shopping text-primary-custom mr-3"></i>
            Keranjang Belanja 
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
           {{-- Daftar Item --}}
            <div class="lg:col-span-2 space-y-6">

                @forelse ($cartItems as $productId => $item)
                <div class="flex flex-col sm:flex-row items-center bg-white rounded-xl shadow-md p-4">

                    {{-- gambar produk --}}
                    <img src="{{asset('/storage/' . $item['image_url'] ?? 'https://placehold.co/100x100?text=Produk') }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg mr-6 mb-4 sm:mb-0 border border-gray-100">
                    
                    <div class="flex-grow">
                        <a href="{{route('User.detailProduct', $item['product_id'] )}}" class="text-lg font-semibold text-gray-900 hover:text-primary-custom ">{{ $item['name'] }}</a>

                        <p class="text-sm text-gray-500 mt-1">Ukuran: {{ $item['size'] ?? '-' }}</p>
                        
                        <p class="text-md font-bold text-red-600 mt-2">Rp {{ number_format($item['price']) }}</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                     <div class="flex items-center border border-gray-300 rounded-lg">
                            <button 
                             wire:click="updateQuantity({{ $productId }}, 'decrease')"
                            class="p-2 text-gray-600 hover:bg-gray-100 rounded-l-lg transition-button">
                            <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="text" 
                            value="{{ $item['quantity']}}" 
                            class="w-10 text-center border-x border-gray-300 py-1 text-sm font-medium focus:outline-none">
                            <button 
                            wire:click="updateQuantity({{ $productId }}, 'increase')"
                            class="p-2 text-gray-600 hover:bg-gray-100 rounded-r-lg transition-button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                     </div>

                        <button
                         wire:click="removeItem({{ $productId }})"
                        class="text-red-500 hover:text-red-700 p-2 rounded-full transition-button hover:bg-red-50">
                        <i class="fa-solid fa-trash-can text-lg"></i>
                        </button>
                    </div>
                </div>
                
                @empty
                    
                <div class="bg-white rounded-xl shadow-md p-10 text-center text-gray-500">
                <i class="fa-solid fa-box-open text-5xl mb-4"></i>
                <p>Keranjang masih kosong.</p>
                </div>
               
                @endforelse

                <!-- Tombol Lanjutkan Belanja -->
                <div class="text-right">
                    <a href="{{route('User.katalog')}}" class="text-primary-custom font-semibold hover:underline flex items-center justify-end">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Lanjutkan Belanja
                    </a>
                </div>

            </div>


            <!-- Ringkasan Belanja -->

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-20 border border-gray-100 flex flex-col">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5 border-b pb-3">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Total</span>
                            <span class="font-semibold">Rp {{number_format($subtotal)}}</span>
                        </div>
                    </div>
                    
                    <a href="{{route('User.CartPayment')}}" class="w-full mt-8 bg-primary-custom text-white py-3 px-12 rounded-full font-bold text-lg transition-button hover:bg-primary-dark shadow-lg text-center">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
        
    </main>
</div>
