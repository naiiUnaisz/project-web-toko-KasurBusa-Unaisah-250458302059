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
                
                <!-- Pencarian  -->
                <div class="hidden md:flex flex-grow max-w-lg mx-10 ">
                    <nav class="hidden md:flex space-x-8 ">
                        <a href="{{route('landingpage')}}" class="text-gray-900 hover:text-primary-custom transition duration-150 font-medium">Home</a>
                        <a href="{{route('User.katalog')}}" class="text-gray-900 hover:text-primary-custom transition duration-150 font-medium">Katalog</a>
                        <a href="#" class="text-gray-900 hover:text-primary-custom transition duration-150 font-medium">Shopping</a>
                    </nav>
                </div>
                
                
                <div class="flex items-center space-x-4">
                    <!-- Wishlist  -->
                    <a href="{{route('User.CartWishlist')}}" class="relative p-2 text-gray-600 hover:text-primary-custom transition duration-150">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <!-- Keranjang Belanja  -->
                    <a href="{{route('User.CartShopping')}}" class="relative p-2 text-gray-600 hover:text-primary-custom transition duration-150">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    @if (Route::has('login'))
                        
                    <a href="{{route('login')}}" class="text-sm font-medium text-white bg-primary-custom py-2 px-4 rounded-full transition duration-150 bg-primary-custom:hover">Login</a>
                    @endif
    
                    @if (Route::has('register'))
                        
                    <a href="{{route('register')}}" class="text-sm font-medium text-white bg-primary-custom py-2 px-4 rounded-full transition duration-150 bg-primary-custom:hover">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </header>
</div>


