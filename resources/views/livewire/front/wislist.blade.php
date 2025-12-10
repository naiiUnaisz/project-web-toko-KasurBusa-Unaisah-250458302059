<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
            <i class="fa-regular fa-heart text-primary-custom mr-3"></i>
            Daftar Keinginan
        </h1>

        <!-- Kontainer Wishlist -->
        <div class="space-y-6">

            <!-- Contoh Item Wishlist 1 -->
            @foreach ( $items as $i )
            <div class="flex flex-col sm:flex-row items-center bg-white rounded-xl shadow-md p-4 transition-transform duration-300 hover:scale-[1.01]">
                <img src="https://placehold.co/100x100/F0F3F4/444?text=Kasur+Inoac" alt="Kasur Busa Inoac D-23" class="w-24 h-24 object-cover rounded-lg mr-6 mb-4 sm:mb-0">
                

                    
                <div class="flex-grow">
                    <a href="#" class="text-xl font-semibold text-gray-900 hover:text-primary-custom transition duration-150">{{ $i->product->name}}</a>
                    <p class="text-sm text-gray-500 mt-1">Ukuran : {{ $i->product->size->name }}</p>
                    <p class="text-lg font-bold text-red-600 mt-2">Rp {{ number_format($i->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="flex flex-col space-y-2 ml-4">
                    <button 
                    wire:click="addToCart({{ $i->product_id }})"
                    class="bg-primary-custom text-white py-2 px-4 rounded-full text-sm font-semibold transition-button hover:bg-primary-dark">
                        <i class="fa-solid fa-cart-plus mr-1"></i>
                        Tambah ke Keranjang
                    </button>
                    <button
                    wire:click="deleteWishlist({{ $i->product_id }})"
                     class="text-gray-500 border border-gray-300 py-2 px-4 rounded-full text-sm font-semibold transition-button hover:bg-gray-100">
                        <i class="fa-solid fa-times mr-1"></i>
                        Hapus
                    </button>
                </div>
            </div>
                @endforeach

           
            
        </div>
    </main>
</div>
