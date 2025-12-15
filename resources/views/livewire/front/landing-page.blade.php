
<div>
    <main>
        
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
                            <a href="{{route('login')}}" class="bg-primary-custom text-white text-lg font-medium py-3 px-8 rounded-full shadow-lg bg-primary-custom:hover">
                                Beli Sekarang
                            </a>
                            @endif
                            
                            <a href="{{route ('User.katalog')}}" class=" border border-primary-custom text-amber-400 text-lg font-medium py-3 px-8 rounded-full hover:bg-primary-custom hover:text-white ">
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

       {{-- produk unggulan --}}
        <section class="py-16">
            <div class="max-w-6xl mx-auto px-3 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-10 text-center">Produk Unggulan Pilihan Pelanggan</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                   
                    @foreach ($products as $product)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl relative flex flex-col">

                        <img 
                            src="{{ $product->primaryImage ? asset('storage/' . $product->primaryImage->image_url) : asset('Frontend/default/no-image.png') }}"
                            alt="{{ $product->name }}"
                            class="w-full h-80 object-cover"
                        >
                    
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                    
                            <p class="mt-2 text-xl font-bold text-primary-custom">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                    
                            <!-- Tombol selalu di bawah -->
                            <div class="mt-auto flex space-x-2 pt-4">
                    
                                <a href="{{ route('User.detailProduct', $product->id) }}"
                                   class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 text-center">
                                    Detail
                                </a>
                    
                                <button 
                                    wire:click="addToCart({{ $product->id }})"
                                    class="flex-1 bg-red-700 text-white py-2 rounded-full text-sm font-semibold hover:bg-red-800">
                                    Keranjang
                                </button>
                    
                            </div>
                    
                        </div>
                    </div>
                    
                @endforeach
                </div>
            </div>
        </section>

        
        <section class="bg-[#662222] py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-[#F5DAA7]"> Kenapa Memilih Toko Kami?</h2>
                    <p class="mt-4 text-xl text-[#f4f4f4]">Kami hadir dengan 5 keunggulan inti untuk pengalaman belanja terbaik Anda.</p>
                </div>
                
                <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    
                    <!-- Fitur: Filter Berlapis  & Sorting  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-filter text-2xl w-8 h-8"></i>
                            <i class="fa-solid fa-arrow-up-wide-short text-2xl" ></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pencarian & Filter Paling Detail</h3>
                        <p class="mt-2 text-gray-500">Filter produk berdasarkan ukuran, merek, jenis busa, dan rentang harga sekaligus. Tidak ada lagi pencarian yang sia-sia!</p>
                    </div>

                    <!-- Fitur: Checkout & Bukti Bayar  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition duration-300">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-credit-card text-2xl"></i>
                            <i class="fa-regular fa-credit-card text-2xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Proses Checkout & Upload Bayar</h3>
                        <p class="mt-2 text-gray-500">Alur checkout . Lakukan pembayaran manual dan unggah bukti bayar langsung di halaman konfirmasi. Praktis!</p>
                    </div>

                    <!-- Fitur: Riwayat & Pelacakan  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-location-dot text-2xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pelacakan Pesanan Real-Time</h3>
                        <p class="mt-2 text-gray-500">Cek riwayat dan status pesanan Anda</p>
                    </div>
                    
                    <!-- Fitur: Rekomendasi  -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl ">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-lightbulb text-2xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Rekomendasi Produk Serupa</h3>
                        <p class="mt-2 text-gray-500">Bingung memilih? Di halaman detail produk, kami akan menampilkan rekomendasi produk serupa yang mungkin Anda suka.</p>
                    </div>

                    <!-- Fitur Tambahan: Garansi -->
                     <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-shield-check text-2xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Garansi Kualitas Resmi</h3>
                        <p class="mt-2 text-gray-500">Semua produk kami datang dengan garansi resmi pabrik. Kami hanya menjual produk kasur berkualitas terbaik.</p>
                    </div>
                    
                    <!-- Fitur Tambahan: Pengiriman -->
                     <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl">
                        <div class="flex items-center space-x-3 text-primary-custom">
                            <i class="fa-solid fa-paper-plane text-2xl"></i>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-gray-900">Pengiriman Cepat & Aman</h3>
                        <p class="mt-2 text-gray-500">Layanan pengiriman yang terpercaya dan Terpercaya hingga depan rumah Anda.</p>
                    </div>
                </div>
            </div>
        </section>

       {{-- Testimoni --}}
        <section class="py-20 bg-[#f4f4f4]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Apa Kata Pelanggan Kami?</h2>
                
                <div class="grid md:grid-cols-3 gap-8">

                    @forelse($reviews as $review)
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md border-t-4 border-primary-custom">
                        <p class="italic text-gray-700">"{{ $review->comment }}"</p>
                        <div class="mt-4 text-sm font-semibold text-gray-900"> {{ $review->user->name }}</div>
                        <div class="flex justify-center text-yellow-400 mt-1">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa-solid fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                        @endfor
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 col-span-3">Belum ada ulasan.</p>
                     @endforelse
                </div>
            </div>
        </section>

    </main>
    
  
</div>



