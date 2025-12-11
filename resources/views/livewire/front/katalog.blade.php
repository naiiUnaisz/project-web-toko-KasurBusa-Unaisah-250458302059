
<div>


    <main class="bg- max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Katalog Produk</h1>

         {{-- SIDEBAR FILTER  --}}
        <div class="flex flex-col lg:flex-row gap-8">
            
           {{-- SIDEBAR FILTER  --}}
            <aside class="w-full lg:w-64 bg-white p-6 rounded-xl shadow-lg flex-shrink-0">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Filter Berlapis</h2>
            
                {{-- Filter Brand --}}
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Merek</h3>
            
                    @foreach ($brands as $b)
                        <label class="flex items-center space-x-2 text-sm text-gray-600">
                            <input 
                                type="checkbox" 
                                wire:model.live="brand" 
                                value="{{ $b->id }}"
                                class="rounded text-primary-custom"
                            >
                            <span>{{ $b->name }}</span>
                        </label>
                    @endforeach
                </div>
            
                {{-- Filter Jenis Busa --}}
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Jenis Busa</h3>
            
                    @foreach ($foams as $f)
                        <label class="flex items-center space-x-2 text-sm text-gray-600">
                            <input 
                                type="checkbox" 
                                wire:model.live="foam" 
                                value="{{ $f->id }}"
                                class="rounded text-primary-custom"
                            >
                            <span>{{ $f->name }}</span>
                        </label>
                    @endforeach
                </div>
            
                {{-- Filter Ukuran --}}
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Ukuran</h3>
            
                    @foreach ($sizes as $s)
                        <label class="flex items-center space-x-2 text-sm text-gray-600">
                            <input 
                                type="checkbox" 
                                wire:model.live="size" 
                                value="{{ $s->id }}"
                                class="rounded text-primary-custom"
                            >
                            <span>{{ $s->name }}</span>
                        </label>
                    @endforeach
                </div>
            
                {{-- Filter Harga --}}
                <div class="mb-6">
                    <h3 class="font-medium text-gray-700 mb-2">Rentang Harga</h3>
            
                    <input 
                        type="range" 
                        wire:model.live="maxPrice" 
                        min="500000" 
                        max="10000000" 
                        step="100000"
                        class="w-full"
                    >
            
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>Rp 500rb</span>
                        <span>Rp {{ number_format($maxPrice) }}</span>
                    </div>
                </div>
            </aside>
            

           {{-- DAFTAR PRODUK --}}
            <section class="flex-grow">
                

                <div class="flex justify-between items-center mb-6 p-4 ">
                    <input type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari kasur di katalog..." 
                    class="w-full border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:ring-primary-500 focus:border-primary-500">
                    <button class="bg-primary-custom text-white p-2 rounded-r-md bg-primary-custom:hover">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>

                {{-- SORTING PRODUK --}}
                <div class="flex justify-between items-center mb-6 p-4 bg-white rounded-lg shadow-md">
                    <p id="product-count" class="text-gray-600 text-sm">Menampilkan {{ $products->count() }} produk</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">Urutkan Berdasarkan:</span>
                        <select 
                        wire:model.live="sort"
                        class="border border-gray-300 rounded-lg p-2 text-sm focus:ring-primary-500 focus:border-primary-500"
                    >
                        <option value="default">Paling Relevan</option>
                        <option value="price-asc">Harga Termurah</option>
                        <option value="price-desc">Harga Termahal</option>
                    </select>
                    
                    </div>
                </div>

                
               

                {{-- CARD PRODUK --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    @forelse ($products as $p)
                    <div class="bg-white rounded-xl shadow-lg p-4">
                
                        {{-- Gambar produk --}}
                        <img 
                        src="{{ $p->images->first() ? asset('storage/'.$p->images->first()->image_url) : asset('Frontend/no-image.png') }}"
                        class="w-full h-40 object-cover rounded-xl"
                         />

                    
                
                        {{-- Nama produk --}}
                        <h3 class="font-semibold mt-3 text-gray-900">
                            {{ $p->name }}
                        </h3>
                
                        {{-- Harga --}}
                        <p class="text-red-700 font-bold mt-1">
                            Rp {{ number_format($p->price) }}
                        </p>

                        <!-- Tombol selalu di bawah -->
                        <div class="mt-auto flex space-x-2 pt-4">
                    
                            <a href="{{route('User.detailProduct', $p->id)}}"
                               class="flex-1 bg-gray-200 text-gray-800 py-2 rounded-full text-sm font-semibold hover:bg-gray-300 transition duration-150 text-center">
                                Detail
                            </a>
                
                            <button 
                                wire:click="addToCart({{ $p->id }})"
                                class="flex-1 bg-red-700 text-white  rounded-full text-sm font-semibold hover:bg-red-800 transition duration-150">
                                Keranjang
                            </button>
                
                        </div>
                
                    </div>
                @empty
                    <div class="col-span-full text-center p-10 bg-white rounded-xl shadow">
                        <i class="fa-solid fa-box text-primary-custom"></i>
                        <p>Tidak ada produk ditemukan.</p>
                    </div>
                @endforelse
                
                
                </div>
                
            </section>
        </div>
    </main>
</div>



