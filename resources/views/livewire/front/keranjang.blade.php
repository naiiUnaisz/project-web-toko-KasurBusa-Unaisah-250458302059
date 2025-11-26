

<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <h4 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
            <i class="fa-solid fa-cart-shopping text-primary-custom mr-3"></i>
            Keranjang Belanja Anda
        </h4>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Daftar Item -->
            <div class="lg:col-span-2 space-y-6">

                <div class="flex flex-col sm:flex-row items-center bg-white rounded-xl shadow-md p-4">
                    {{-- gambar produk --}}
                    <img src="{{ $item['image_url'] ?? 'https://placehold.co/100x100/F0F3F4/444?text=Produk' }}" alt="{{ $item['name'] }}" class="w-24 h-24 object-cover rounded-lg mr-6 mb-4 sm:mb-0 border border-gray-100">
                    
                    <div class="flex-grow">
                        <a href="#" class="text-lg font-semibold text-gray-900 hover:text-primary-custom transition duration-150">{{ $item['name'] }}</a>
                        <p class="text-sm text-gray-500 mt-1">Ukuran: {{ $item['size'] ?? '-' }}, Warna: {{ $item['color'] ?? '-' }}</p>
                        <p class="text-md font-bold text-red-600 mt-2">Rp {{ number_format($item['price'] ?? 0, 0, ',', '.') }}</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-l-lg transition-button"><i class="fa-solid fa-minus"></i></button>
                            <input type="text" value="1" class="w-10 text-center border-x border-gray-300 py-1 text-sm font-medium focus:outline-none">
                            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-r-lg transition-button"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <button class="text-red-500 hover:text-red-700 p-2 rounded-full transition-button hover:bg-red-50">
                            <i class="fa-solid fa-trash-can text-lg"></i>
                        </button>
                    </div>
                </div>

                <!-- Contoh Item Keranjang 2 -->
                <div class="flex flex-col sm:flex-row items-center bg-white rounded-xl shadow-md p-4">
                    <img src="https://placehold.co/100x100/F0F3F4/444?text=Bantal" alt="Bantal Guling Premium" class="w-24 h-24 object-cover rounded-lg mr-6 mb-4 sm:mb-0">
                    
                    <div class="flex-grow">
                        <a href="#" class="text-lg font-semibold text-gray-900 hover:text-primary-custom transition duration-150">Bantal Guling Premium</a>
                        <p class="text-sm text-gray-500 mt-1">Isi: Dacron, Jumlah: 2 pcs</p>
                        <p class="text-md font-bold text-red-600 mt-2">Rp 150.000</p>
                    </div>

                    <div class="flex items-center space-x-4 mt-4 sm:mt-0">
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-l-lg transition-button"><i class="fa-solid fa-minus"></i></button>
                            <input type="text" value="2" class="w-10 text-center border-x border-gray-300 py-1 text-sm font-medium focus:outline-none">
                            <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-r-lg transition-button"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <button class="text-red-500 hover:text-red-700 p-2 rounded-full transition-button hover:bg-red-50">
                            <i class="fa-solid fa-trash-can text-lg"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Tombol Lanjutkan Belanja -->
                <div class="text-right">
                    <a href="{{route('User.katalog')}}" class="text-primary-custom font-semibold hover:underline transition duration-150 flex items-center justify-end">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Lanjutkan Belanja
                    </a>
                </div>

            </div>

            <!-- Ringkasan Belanja -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-20 border border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-5 border-b pb-3">Ringkasan Pesanan</h2>
                    
                    <div class="space-y-3 text-gray-700">
                        <div class="flex justify-between">
                            <span>Total Harga (3 Item)</span>
                            <span class="font-medium">Rp 1.950.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Biaya Pengiriman</span>
                            <span class="font-medium">Rp 50.000</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Diskon (Kode Promo)</span>
                            <span class="font-medium text-green-600">- Rp 0</span>
                        </div>
                    </div>

                    <div class="mt-5 pt-5 border-t border-dashed border-gray-300 flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">Total Pembayaran</span>
                        <span class="text-2xl font-extrabold text-red-600">Rp 2.000.000</span>
                    </div>
                    
                    <a href="{{route('User.CartPayment')}}" class="w-full mt-8 bg-primary-custom text-white py-3 px-12 rounded-full font-bold text-lg transition-button hover:bg-primary-dark shadow-lg ">
                        Lanjut ke Pembayaran
                    </a>
                </div>
            </div>
        </div>
        
    </main>
</div>
