<div>
    <header class="sticky top-0 bg-[#EEEBDD] shadow-md z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center justify-center w-40 rounded-lg p-2 shadow-md" style="background-color: rgb(239, 218, 218)">
                    <img
                    src="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}"
                    alt="logo"
                    class="h-7 w-auto object-contain"
                    />
                </div>
                
                <div class="flex flex-grow max-w-lg mx-10">
                    <input type="search" id="search-input" placeholder="Cari kasur di katalog..." class="w-full border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:ring-primary-500 focus:border-primary-500">
                    <button id="search-button" class="bg-primary-custom text-white p-2 rounded-r-md transition duration-150 bg-primary-custom:hover">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                
                <div class="flex items-center space-x-4">
                    <a href="{{route('User.CartWishlist')}}" class="relative p-2 text-gray-600 hover:text-primary-custom transition duration-150"><i class="fa-regular fa-heart"></i>
                    </a>                    
                    <a href="{{route('User.CartShopping')}}" class="relative p-2 text-gray-600 hover:text-primary-custom transition duration-150"><i class="fa-solid fa-cart-shopping"></i></a>
                    
                </div>
            </div>
        </div>
    </header>
</div>




