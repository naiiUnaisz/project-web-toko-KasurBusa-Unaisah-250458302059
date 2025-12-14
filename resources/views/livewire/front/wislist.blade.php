<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <h2 class="text-3xl  font-bold text-gray-900 mb-8 border-b pb-4">
            <i class="fa-solid fa-heart text-primary-custom"></i>
            Daftar Wishlist
        </h2>

        <div class="space-y-6">

            @forelse ( $items as $i )
            <div class="flex flex-col sm:flex-row items-center bg-white rounded-xl shadow-md p-4 duration-300 hover:scale-[1.01]">
                <img src="{{asset('/storage/' . $i->product->images->first()->image_url) }}" alt="{{ $i['name'] }}"class="w-24 h-24 object-cover rounded-lg mr-6 mb-4 sm:mb-0">
                    
                <div class="flex-grow">
                    <a href="{{route('User.detailProduct', $i['product_id'] )}}" class="text-xl font-semibold text-gray-900 hover:text-primary-custom">{{ $i->product->name}}</a>
                    <p class="text-sm text-gray-500 mt-1">Ukuran : {{ $i->product->size->name }}</p>
                    <p class="text-lg font-bold text-red-600 mt-2">Rp {{ number_format($i->product->price, 0, ',', '.') }}</p>
                </div>

                <div class="flex flex-col space-y-2 ml-4">
                    <button 
                    wire:click="addToCart({{ $i->product_id }})"
                    class="bg-primary-custom text-white py-2 px-4 rounded-full text-sm font-semibold hover:bg-primary-dark">
                        <i class="fa-solid fa-cart-plus mr-1"></i>
                        Tambah ke Keranjang
                    </button>
                    <button
                    wire:click="deleteWishlist({{ $i->product_id }})"
                     class="text-gray-500 border border-gray-300 py-2 px-4 rounded-full text-sm font-semibold hover:bg-gray-100">
                     @if (in_array($i->product_id, $wishlistId)) 
                     <i class="fa-solid fa-heart text-primary-custom"></i> 
                     @else
                     <i class="fa-regular fa-heart"></i>
                     @endif
                     
                    </button>
                </div>
            </div>
            @empty
                    
            <div class="bg-white rounded-xl shadow-md p-10 text-center text-gray-500">
            <i class="fa-regular fa-heart text-5xl mb-4"></i>
            <p>Wishlish masih kosong.</p>
            </div>
           
            @endforelse
            
        </div>
    </main>
</div>
