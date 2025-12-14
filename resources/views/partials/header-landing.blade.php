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
                <div class="flex justify-center md:flex flex-grow max-w-lg mx-10 ">
                    <nav class="  md:flex space-x-8 ">
                        <a href="{{route('landingpage')}}" class="text-gray-900 hover:text-yellow-700  font-medium">Home</a>

                        <a href="{{ route('User.katalog') }}" 
                        class="text-gray-900 hover:text-yellow-700 font-medium">

                            @if (request()->routeIs('User.detailProduct'))
                                Produk
                            @else
                                Katalog
                            @endif

                        </a>

                        <a href="{{route('User.Checkout')}}" class="text-gray-900 hover:text-yellow-700 font-medium">Shopping</a>

                    </nav>
                </div>
                
                
                <div class="flex items-center space-x-4">
                    <!-- Wishlist  -->
                    <a href="{{route('User.CartWishlist')}}" class="relative p-2 text-gray-600 hover:text-yellow-700">
                        <i class="fa-solid fa-heart"></i>
                    </a>
                    <!-- Keranjang Belanja  -->
                    <a href="{{route('User.CartShopping')}}" class="relative p-2 text-gray-600 hover:text-yellow-700 ">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    @guest
                    
                    @if (Route::has('login')) 
                    <a href="{{route('login')}}" class="text-sm font-medium text-white bg-primary-custom py-2 px-4 rounded-full  bg-primary-custom:hover">Login</a>
                    @endif
    
                    @if (Route::has('register'))
                    <a href="{{route('register')}}" class="text-sm font-medium text-white bg-primary-custom py-2 px-4 rounded-full transition duration-150 bg-primary-custom:hover">Register</a>
                    @endif
                    @else
                        <li class="nav-item dropdown list-unstyled">

                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">

                                <img class="rounded-circle  "
                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=991b1b&color=fff"
                                    alt="{{ Auth::user()->name }}"
                                    style="width: 40px; height: 40px;">

                                <span class="fw-semibold text-danger">
                                    Hello, {{ Auth::user()->name }}
                                </span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow ">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        Profil Saya
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('dashboard') }}">
                                        Dashboard
                                    </a>
                                </li>

                                <li><hr class="dropdown-divider "></li>

                                <li>
                                    <a class="dropdown-item text-danger"
                                        href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                @endguest

                </div>
            </div>
        </div>
    </header>
</div>


