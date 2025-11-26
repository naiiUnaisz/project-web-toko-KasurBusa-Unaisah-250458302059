{{-- @extends('layouts.landingPage')
@section('content') --}}
<div>
    <main>
        
        <!-- BLOK 2: HERO SECTION (Call to Action untuk Filter/Sorting) -->
        <section class="bg-[#662222] py-20 md:py-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
        
                    <div>
                        <span class="text-sm font-semibold text-[#f67b4aca] uppercase tracking-wider">Tidur Nyenyak, Hidup Berkualitas</span>
                        <h1 class="mt-4 text-4xl font-extrabold tracking-tight text-[#F5DAA7] sm:text-5xl md:text-6xl">
                            Kasur Nyaman, Awetnya <br> Bertahun - tahun
                        </h1>
                        <p class="mt-6 text-lg text-[#f4f4f4]">
                            Tidur berkualitas berawal dari kasur yang tepat. <br> Busa Cileungsi menghadirkan kasur dengan kepadatan ideal tidak mudah kempes, tetap nyaman, dan tahan lama. 
                            <br>Solusi bagi Anda yang ingin tidur nyenyak tanpa khawatir kasur cepat rusak.
                        </p>
                        <div class="mt-8 flex space-x-4">
                            @if (Route::has('login'))
                                
                            <a href="{{route('login')}}" class="bg-primary-custom text-white text-lg font-medium py-3 px-8 rounded-full shadow-lg transition duration-300 bg-primary-custom:hover">
                                Beli Sekarang
                            </a>
                            @endif
                            <a href="{{route ('User.katalog')}}" class=" border border-primary-custom text-amber-400 text-lg font-medium py-3 px-8 rounded-full hover:bg-primary-custom hover:text-white transition duration-300">
                                Lihat Katalog
                            </a>
                        </div>
                    </div>
                    <!-- kanan gambar -->
                    <div class="hidden md:block">
                        <img src="{{asset ('Frontend/landingPage_TokoKasur/img/gambar toko kasur.webp')}}" alt="Ilustrasi Kasur" class="w-full h-auto rounded-xl shadow-2xl">
                    </div>
                </div>
            </div>
        </section>

        <!-- BLOK 3: PRODUCT SHOWCASE -->
        <section class="py-16">
            <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">Produk Unggulan Pilihan Pelanggan</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                   
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl relative">
                        <!-- Wishlist  -->
                        <button class="absolute top-3 right-3 p-2 bg-white/80 rounded-full text-red-500 hover:text-red-700 transition duration-150">
                            <i data-lucide="heart" class="w-5 h-5 fill-red-500"></i>
                        </button>
                        <img src="{{ asset('Frontend/landingPage_TokoKasur/img/kasur-Royal.jpg')}}" alt="Produk 1" class="w-full h-100 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-900">Kasur Royal D25 180 x 20</h3>
                            <!-- Rating  -->
                            <div class="flex items-center mt-1">
                                <span class="flex text-yellow-400">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i data-lucide="star" class="w-4 h-4 text-gray-300"></i>
                                </span>
                                <span class="ml-2 text-sm text-gray-500">(4.2)</span>
                            </div>
                            <p class="mt-2 text-xl font-bold text-primary-custom"> Rp 1.580.000</p>
                            <div class="flex space-x-2 mt-4"> 
                            <button class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 transition duration-150">
                                Detail
                            </button>
                            
                            <a href="{{ route('User.CartShopping')}}" class="flex-1 bg-red-700 text-white py-2 rounded-full text-sm font-semibold hover:bg-red-800 transition duration-150">
                               Tambah Keranjang
                            </a>
                        </div>
                        </div>
                    </div>
                    <!-- Kartu Produk 2 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl relative">
                        <button class="absolute top-3 right-3 p-2 bg-white/80 rounded-full text-gray-400 hover:text-red-700 transition duration-150">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                        <img src="{{asset ('Frontend/landingPage_TokoKasur/img/inoac-D24.jpg')}}" alt="Produk 2" class="w-full h-100 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-900">INOAC  D24  160 x 20</h3>
                            <div class="flex items-center mt-1">
                                <span class="flex text-yellow-400">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <span class="ml-2 text-sm text-gray-500">(5.0)</span>
                            </div>
                            <p class="mt-2 text-xl font-bold text-primary-custom">Rp 1.380.000</p>
                        <div class="flex space-x-2 mt-4"> 
                        <button class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 transition duration-150">
                                Detail
                            </button>
                            
                            <button class="flex-1 bg-red-700 text-white py-2 rounded-full text-sm font-semibold hover:bg-red-800 transition duration-150">
                               Tambah Keranjang
                            </button>
                        </div>
                        </div>
                    </div>
                    <!-- Kartu Produk 3 -->
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transition duration-300 hover:shadow-xl relative">
                        <button class="absolute top-3 right-3 p-2 bg-white/80 rounded-full text-gray-400 hover:text-red-700 transition duration-150">
                            <i data-lucide="heart" class="w-5 h-5"></i>
                        </button>
                        <img src="{{ asset ('Frontend/landingPage_TokoKasur/img/sofabed.jpg')}}" alt="Produk 3" class="w-full h-100 object-cover">
                        <div class="p-5">
                            <h3 class="text-lg font-semibold text-gray-900">Sofabed Royal 120 x 20</h3>
                            <div class="flex items-center mt-1">
                                <span class="flex text-yellow-400">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                                <span class="ml-2 text-sm text-gray-500">(2.8)</span>
                            </div>
                            <p class="mt-2 text-xl font-bold text-primary-custom"> Rp 1.350.000</p>

                            <div class="flex space-x-2 mt-4"> 
                                <a href="{{ route('User.detailProduct', 1) }}" class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 transition duration-150 ">
                                    Detail
                                </a>
                            
                            <button class="flex-1 bg-red-700 text-white py-2 rounded-full text-sm font-semibold hover:bg-red-800 transition duration-150">
                               Tambah Keranjang
                            </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="bg-[#662222] py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-[#F5DAA7]">Kenapa Memilih Toko Kami?</h2>
                    <p class="mt-4 text-xl text-[#f4f4f4]">Kami hadir dengan 5 keunggulan inti untuk pengalaman belanja terbaik Anda.</p>
                </div>
                
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Fitur: Filter Berlapis  & Sorting  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="filter" class="w-8 h-8"></i>
                            <i data-lucide="arrow-down-up" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pencarian & Filter Paling Detail</h3>
                        <p class="mt-2 text-gray-500">Filter produk berdasarkan **ukuran, merek, jenis busa,** dan **rentang harga** sekaligus. Tidak ada lagi pencarian yang sia-sia!</p>
                    </div>

                    <!-- Fitur: Checkout & Bukti Bayar  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="credit-card" class="w-8 h-8"></i>
                            <i data-lucide="upload" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Proses Checkout & Upload Bayar</h3>
                        <p class="mt-2 text-gray-500">Alur *checkout* cepat. Lakukan pembayaran manual dan **unggah bukti bayar** langsung di halaman konfirmasi. Praktis!</p>
                    </div>

                    <!-- Fitur: Riwayat & Pelacakan  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="map-pin" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pelacakan Pesanan Real-Time</h3>
                        <p class="mt-2 text-gray-500">Cek **riwayat dan status pesanan** Anda, mulai dari proses verifikasi hingga pengiriman, semuanya dalam satu halaman.</p>
                    </div>
                    
                    <!-- Fitur: Rekomendasi  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="lightbulb" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Rekomendasi Cerdas Serupa</h3>
                        <p class="mt-2 text-gray-500">Bingung memilih? Di halaman detail produk, kami akan menampilkan **rekomendasi produk serupa** yang mungkin Anda suka.</p>
                    </div>

                    <!-- Fitur Tambahan: Garansi -->
                     <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="shield-check" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Garansi Kualitas Resmi</h3>
                        <p class="mt-2 text-gray-500">Semua produk kami datang dengan garansi resmi pabrik. Kami hanya menjual produk kasur berkualitas terbaik.</p>
                    </div>
                    
                    <!-- Fitur Tambahan: Pengiriman -->
                     <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i data-lucide="send" class="w-8 h-8"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pengiriman Cepat & Aman</h3>
                        <p class="mt-2 text-gray-500">Layanan pengiriman yang terpercaya dan berasuransi hingga ke depan rumah Anda.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BLOK 5: TESTIMONIALS  -->
        <section class="py-20 bg-[#f4f4f4]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Apa Kata Pelanggan Kami?</h2>
                <p class="text-gray-600 mb-12">Bukti kepuasan dari ribuan pembeli (Sistem Ulasan & Rating)</p>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md border-t-4 border-primary-custom">
                        <p class="italic text-gray-700">"Fitur filternya sangat membantu, saya bisa langsung menemukan kasur dengan ukuran dan jenis busa yang saya cari. Pelayanan cepat!"</p>
                        <div class="mt-4 text-sm font-semibold text-gray-900">Ani S.</div>
                        <div class="flex justify-center text-yellow-400 mt-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md border-t-4 border-primary-custom">
                        <p class="italic text-gray-700">"Proses upload bukti bayar sangat mudah, tidak perlu kirim-kirim email. Status pesanan pun selalu update, sangat puas!"</p>
                        <div class="mt-4 text-sm font-semibold text-gray-900">Budi K.</div>
                        <div class="flex justify-center text-yellow-400 mt-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star w-4 h-4 text-gray-300"></i>
                        </div>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md border-t-4 border-primary-custom">
                        <p class="italic text-gray-700">"Wishlist-nya sangat berguna! Saya bisa simpan beberapa kasur untuk dibandingkan nanti. Fitur favorit yang wajib ada."</p>
                        <div class="mt-4 text-sm font-semibold text-gray-900">Citra M.</div>
                        <div class="flex justify-center text-yellow-400 mt-1">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    
  
</div>
{{-- @endsection   --}}


