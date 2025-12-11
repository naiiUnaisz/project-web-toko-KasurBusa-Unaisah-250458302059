

<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
    
        <nav class="text-sm mb-6">
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-primary-custom">Home /</a> 
            <a href="{{ route('User.katalog') }}" class="text-gray-500 hover:text-primary-custom">Produk /</a> 
            <span class="font-medium text-gray-700">{{ $product->name }}</span>


        </nav>


        <div class="bg-white p-6 md:p-10 rounded-xl shadow-lg grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="lg:sticky lg:top-20 h-fit">
               {{-- Gambar Utama --}}
                <img id="main-image"
                src="{{ asset('storage/' . $product->primaryImage?->image_url) }}"
                class="w-full h-auto rounded-xl shadow-md object-cover">
           
                
                 {{-- Galeri Gambar Mini --}}
                <div class="flex space-x-3 mt-4 overflow-x-auto">

                    @foreach ($product->images as $img)

                    <img src="{{ asset('storage/' . $img->image_url) }}"
                    data-full-img="{{ asset('storage/' . $img->image_url) }}"
                    class="thumbnail w-20 h-20 rounded-lg object-cover border-2 border-gray-200 cursor-pointer hover:border-primary-custom">

                     @endforeach
                </div>
            </div>
            <div class="flex flex-col justify-center">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">
                    {{ $product->name }}
                </h1>
                
                
                {{-- Rating Ulasan --}}
                <div class="flex items-center mb-4 border-b pb-4">
                    <div class="flex items-center space-x-1">
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star w-4 h-4 
                            {{ $averageRating >= $i ? 'text-yellow-400' : 'text-gray-300' }}">
                        </i>
                    @endfor
                
                    <span class="text-lg font-bold ml-1 text-gray-800">
                        {{ $averageRating ? number_format($averageRating, 1) : '' }}
                    </span>
                </div>
                
                <span class="text-sm text-gray-500 ml-4">
                    ({{ $reviews->count() }} Ulasan)
                </span>
                </div>
                
                {{-- Harga --}}
                <p class="text-2xl font-bold text-red-600 py-11 mb-6">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </p>
                

                {{-- <!-- Pilihan Varian -->
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
                </div> --}}
                
                {{-- Kontrol kuantitas & stok --}}
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
                    <span class="text-sm text-gray-500">
                        Stok Tersedia: {{ $product->stock_quantity }}
                    </span>
                    
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <button 
                    wire:click="addToCart"
                    class="flex-1 px-6 py-3 rounded-xl bg-primary-custom hover:bg-primary-dark text-white font-bold text-lg transition-button flex items-center justify-center space-x-2">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>TAMBAH KE KERANJANG</span>
                    </button>
                    <button 
                    wire:click="addWishlist({{ $product->id }})"
                    class="px-6 py-3 rounded-xl border-2 border-primary-custom text-primary-custom font-bold text-lg hover:bg-primary-custom hover:text-yellow-600 transition-button flex items-center justify-center space-x-2">
                        <i class="fa-regular fa-heart"></i>
                        <span>Wishlist</span>
                    </button>
                </div>
                
                {{-- Tombol chat WA --}}
                <a href="https://wa.me/6283890909067?text=Halo%2C%20saya%20tertarik%20dengan%20produk%20Kasur%20Busa%20Inoac%20EON%20D-23." target="_blank"
                    class="mt-4 w-full flex items-center justify-center space-x-2 whatsapp-float text-white px-6 py-3 rounded-xl font-bold text-lg transition-button">
                    <i class="fab fa-whatsapp text-xl"></i>
                    <span>Chat via WhatsApp</span>
                </a>
            </div>
        </div>

       {{-- Tambah Deskripsi & Ulasan --}}
<div class="mt-10 bg-white p-6 md:p-10 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-900 border-b pb-3 mb-6">Deskripsi & Ulasan</h2>

    <div id="tab-container">
       {{-- tab  --}}
        <div class="flex border-b mb-6">
            <button id="tab-description"
                class="tab-button px-4 py-2 text-lg font-semibold border-b-2 border-primary-custom text-primary-custom">
                Deskripsi Produk
            </button>

            <button
                id="tab-reviews"
                class="tab-button px-4 py-2 text-lg font-semibold text-gray-500 border-b-2 border-transparent hover:text-gray-700">
                Ulasan ({{ $reviews->count() }})
            </button>
        </div>

       {{-- tab deskripsi --}}
        <div id="content-description" class="tab-content">
            <h3 class="text-xl font-semibold mb-3">{{ $product->name }}</h3>
            <p class="text-gray-700 mb-4">
                {!! nl2br(e($product->deskripsi)) !!}
            </p>
        </div>

       {{-- tab ulasan --}}
        <div id="content-reviews" class="tab-content hidden">
            <div class="space-y-6">

                @forelse ($reviews as $review)
                    <div class="border-b pb-4">
                        
                        <div class="flex items-center space-x-1 text-yellow-400 mb-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                            @endfor

                            <span class="ml-2 text-sm font-semibold text-gray-700">
                                {{ $review->user->name ?? 'Pengguna' }}
                            </span>

                            <span class="ml-2 text-xs text-gray-500">
                                {{ $review->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <p class="text-gray-700 italic">"{{ $review->comment }}"</p>
                    </div>
                @empty
                    <p class="text-gray-500 italic">Belum ada ulasan untuk produk ini.</p>
                @endforelse

            </div>

           {{-- form ulasan --}}
            @if(auth()->check())
                <div class="mt-8 bg-gray-50 p-6 rounded-xl border">

                    <h3 class="text-xl font-semibold mb-4">Tulis Ulasan Anda</h3>

                    <form wire:submit.prevent="submitReview" class="space-y-4">

                        <!-- Rating -->
                        <div>
                            <label class="block font-medium mb-1">Rating:</label>

                            <div class="flex space-x-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <span 
                                        wire:click="$set('rating', {{ $i }})"
                                        class="cursor-pointer text-3xl 
                                            {{ $rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}">
                                        ★
                                    </span>
                                @endfor
                            </div>
                        </div>

                       {{-- review text --}}
                        <div>
                            <label class="block font-medium mb-1">Ulasan:</label>
                            <textarea wire:model.defer="reviewText" rows="4"
                                class="w-full border rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom"></textarea>

                            @error('reviewText') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            wire:click="submitReview"
                            class="bg-primary-custom text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-dark">
                            Kirim Ulasan
                        </button>

                    </form>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- produk rekomendasi --}}
<div class="mt-16">
    <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">
        Produk Serupa yang Mungkin Kamu Suka
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

        @forelse ($relatedProducts as $item)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                
               {{-- gambar --}}
                <a href="{{ route('User.detailProduct', $item->id) }}">
                    <img src="{{ asset('storage/' . $item->primaryImage?->image_url) }}"
                         class="w-full h-48 object-cover"
                         alt="{{ $item->name }}">
                </a>

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">
                        {{ $item->name }}
                    </h3>

                    <p class="text-red-600 font-bold mt-2">
                        Rp {{ number_format($item->price, 0, ',', '.') }}
                    </p>

                    <div class="flex space-x-2 mt-4">
                        <a href="{{ route('User.detailProduct', $item->id) }}"
                            class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 text-center">
                            Detail
                        </a>

                        <button 
                            wire:click="addToCart({{ $item->id }})" 
                            class="flex-1 bg-primary-custom text-white py-2 rounded-full text-sm font-semibold hover:bg-primary-dark">
                            Keranjang
                        </button>
                    </div>
                </div>
            </div>

        @empty
            <p class="text-gray-500 text-center w-full">Tidak ada produk terkait.</p>
        @endforelse

    </div>
</div>

    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabDescription = document.getElementById('tab-description');
        const tabReviews = document.getElementById('tab-reviews');
    
        const contentDescription = document.getElementById('content-description');
        const contentReviews = document.getElementById('content-reviews');
    
        tabDescription.addEventListener('click', function () {
            // tampilkan deskripsi
            contentDescription.classList.remove('hidden');
            contentReviews.classList.add('hidden');
    
            // style aktif
            tabDescription.classList.add('border-primary-custom', 'text-primary-custom');
            tabReviews.classList.remove('border-primary-custom', 'text-primary-custom');
            tabReviews.classList.add('text-gray-500');
        });
    
        tabReviews.addEventListener('click', function () {
            // tampilkan ulasan
            contentReviews.classList.remove('hidden');
            contentDescription.classList.add('hidden');
    
            // style aktif
            tabReviews.classList.add('border-primary-custom', 'text-primary-custom');
            tabDescription.classList.remove('border-primary-custom', 'text-primary-custom');
            tabDescription.classList.add('text-gray-500');
        });
    });
    </script>
    
