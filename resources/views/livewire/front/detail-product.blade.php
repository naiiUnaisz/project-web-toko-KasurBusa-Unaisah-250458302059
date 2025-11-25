@extends('layouts.detailProduct')
@section('detail')

<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
    
        <nav class="text-sm mb-6">
            <a href="#" class="text-gray-500 hover:text-primary-custom">Home</a> 
            <a href="#" class="text-gray-500 hover:text-primary-custom">Produk</a> 
            <span class="font-medium text-gray-700">Kasur Busa Inoac</span>
        </nav>


        <div class="bg-white p-6 md:p-10 rounded-xl shadow-lg grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="lg:sticky lg:top-20 h-fit">
                <!-- Gambar Utama -->
                <img id="main-image" src="img/inoac-D24.jpg" 
                     alt="Kasur Busa Inoac" class="w-full h-auto rounded-xl shadow-md object-cover">
                
                <!-- Galeri Gambar Mini -->
                <div class="flex space-x-3 mt-4 overflow-x-auto">
                    <!-- Thumbnail 1  -->
                    <img src="img/inoac-D24.jpg" data-full-img="https://placehold.co/800x600/F0F3F4/444?text=INOAC+UTAMA"
                         alt="Thumbnail 1" class="thumbnail w-20 h-20 rounded-lg object-cover border-2 border-primary-custom cursor-pointer transition duration-150">
                    <!-- Thumbnail 2 -->
                    <img src="img/kasur-Royal.jpg" data-full-img="https://placehold.co/800x600/F0F3F4/444?text=DETAIL+BUSA"
                         alt="Thumbnail 2" class="thumbnail w-20 h-20 rounded-lg object-cover border-2 border-gray-200 cursor-pointer hover:border-primary-custom transition duration-150">
                    <!-- Thumbnail 3 -->
                    <img src="img/logo_buscil.png" data-full-img="https://placehold.co/800x600/F0F3F4/444?text=MOTIF+SARUNG"
                         alt="Thumbnail 3" class="thumbnail w-20 h-20 rounded-lg object-cover border-2 border-gray-200 cursor-pointer hover:border-primary-custom transition duration-150">
                </div>
            </div>
            
            <!-- Kolom Kanan: Informasi & Aksi -->
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Kasur Busa Inoac EON D-23 (200x180x20)</h1>
                
                <!-- Rating dan Ulasan -->
                <div class="flex items-center mb-4 border-b pb-4">
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star w-4 h-4 text-yellow-400"></i>
                        <i class="fas fa-star w-4 h-4 text-yellow-400"></i>
                        <i class="fas fa-star w-4 h-4 text-yellow-400"></i>
                        <i class="fas fa-star w-4 h-4 text-yellow-400"></i>
                        <i class="fas fa-star w-4 h-4 text-gray-300"></i>
                        <span class="text-lg font-bold ml-1 text-gray-800">4.8</span>
                    </div>
                    <span class="text-sm text-gray-500 ml-4">(125 Ulasan)</span>
                    <span class="text-sm text-gray-500 ml-4">| Terjual: 375</span>
                </div>
                
                <!-- Harga -->
                <div class="mb-6">
                    <p class="text-2xl font-bold text-red-600">Rp 1.650.000</p>
                </div>

                <!-- Pilihan Varian -->
                <div class="mb-6">
                    <label class="block text-lg font-semibold text-gray-900 mb-2">Pilih Ukuran:</label>
                    <div class="flex flex-wrap gap-3">
        
                        <button class="px-4 py-2 border rounded-full text-sm transition duration-150 bg-primary-custom text-white border-primary-custom shadow-md">
                            200x180x20 (Rp 1.650rb)
                        </button>
                        <button class="px-4 py-2 border rounded-full text-sm transition duration-150 border-gray-300 text-gray-700 hover:bg-gray-100">
                            200x160x20 (Rp 1.500rb)
                        </button>
                        <button class="px-4 py-2 border rounded-full text-sm transition duration-150 border-gray-300 text-gray-700 hover:bg-gray-100">
                            200x120x20 (Rp 1.100rb)
                        </button>
                    </div>
                </div>
                
                <!-- Kontrol Kuantitas & Stok -->
                <div class="mb-8 flex items-center space-x-6">
                    <label class="text-lg font-semibold text-gray-900">Kuantitas:</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">
                        <button id="qty-minus" class="px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 transition-button">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <input type="number" id="quantity-input" value="1" min="1" max="10" readonly
                               class="w-16 text-center border-y-0 border-x border-gray-300 focus:ring-0 focus:border-gray-300 text-gray-800">
                        <button id="qty-plus" class="px-3 py-2 bg-gray-100 text-gray-600 hover:bg-gray-200 transition-button">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                    <span class="text-sm text-gray-500">Stok Tersedia: 10</span>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button class="flex-1 px-6 py-3 rounded-xl bg-primary-custom hover:bg-primary-dark text-white font-bold text-lg transition-button flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>TAMBAH KE KERANJANG</span>
                    </button>
                    <button class="px-6 py-3 rounded-xl border-2 border-primary-custom text-primary-custom font-bold text-lg hover:bg-primary-custom hover:text-yellow-600 transition-button flex items-center justify-center space-x-2">
                        <i class="fa-regular fa-heart"></i>
                        <span>Wishlist</span>
                    </button>
                </div>
                
                <!-- Tombol Chat WA -->
                <a href="https://wa.me/6283890909067?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20Kasur%20Busa%20Inoac%20EON%20D-23." target="_blank"
                    class="mt-4 w-full flex items-center justify-center space-x-2 whatsapp-float text-white px-6 py-3 rounded-xl font-bold text-lg transition-button">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>Chat via WhatsApp</span>
                </a>
            </div>
        </div>

        <!-- Sesi Tambahan: Deskripsi & Ulasan -->
        <div class="mt-10 bg-white p-6 md:p-10 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold text-gray-900 border-b pb-3 mb-6">Deskripsi & Ulasan</h2>
            
            <!-- Tabs -->
            <div id="tab-container">
                <!-- Tab Headers -->
                <div class="flex border-b mb-6">
                    <button onclick="changeTab('description')" id="tab-description" 
                            class="tab-button px-4 py-2 text-lg font-semibold transition duration-150 border-b-2 border-primary-custom text-primary-custom">
                        Deskripsi Produk
                    </button>
                    <button onclick="changeTab('reviews')" id="tab-reviews"
                            class="tab-button px-4 py-2 text-lg font-semibold transition duration-150 text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                        Ulasan (125)
                    </button>
                </div>

                <!-- Tab Content: Deskripsi -->
                <div id="content-description" class="tab-content">
                    <h3 class="text-xl font-semibold mb-3">Kasur Busa Inoac EON D-23</h3>
                    <p class="text-gray-700 mb-4">Kasur busa premium dari Inoac dengan density EON D-23 yang terkenal padat, empuk, dan memiliki daya tahan tinggi. Ideal untuk menopang tulang belakang dan menjamin tidur nyenyak bertahun-tahun. Garansi resmi 10 Tahun.</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-700">
                        <li>**Density Busa:** EON D-23 (High Density)</li>
                    </ul>
                </div>

                <!-- Tab Content: Ulasan -->
                <div id="content-reviews" class="tab-content hidden">
                    <div class="space-y-6">
                        <!-- Ulasan 1 -->
                        <div class="border-b pb-4">
                            <div class="flex items-center space-x-1 text-yellow-400 mb-2">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                <span class="ml-2 text-sm font-semibold text-gray-700">Budi S.</span>
                            </div>
                            <p class="text-gray-700 italic mb-2">"Busa padat sekali, sesuai deskripsi. Pengiriman cepat. Recommended seller!"</p>
                            <p class="text-xs text-gray-500">Diupload 2 minggu lalu</p>
                        </div>
                         <!-- Ulasan 2 -->
                        <div class="border-b pb-4">
                            <div class="flex items-center space-x-1 text-yellow-400 mb-2">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star text-gray-300"></i>
                                <span class="ml-2 text-sm font-semibold text-gray-700">Santi W.</span>
                            </div>
                            <p class="text-gray-700 italic mb-2">"Agak keras di awal, tapi sangat nyaman setelah terbiasa. Kualitas busa top!"</p>
                            <p class="text-xs text-gray-500">Diupload 1 bulan lalu</p>
                        </div>
                        <p class="text-center text-primary-custom hover:opacity-80 cursor-pointer font-medium mt-4">Lihat Semua Ulasan (125)</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection