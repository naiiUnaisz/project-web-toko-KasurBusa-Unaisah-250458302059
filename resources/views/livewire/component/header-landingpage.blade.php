<div>
    <header   x-data="{ open: false }"
    class="sticky top-0 bg-[#EEEBDD] shadow-md z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

               {{-- logo --}}
                <div class="flex items-center justify-center w-36 sm:w-40 rounded-lg p-2 shadow-md"
                 style="background-color: rgb(239, 218, 218)">
                    <img
                      src="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}"
                      alt="logo"
                      class="h-7 w-auto object-contain"
                    />
                  </div>
                
                {{-- pencarian --}}
                <div class="hidden md:flex flex-grow justify-center">
                    <nav class="flex space-x-6">
                        <a href="{{ route('landingpage') }}"
                           class="font-bold {{ request()->routeIs('landingpage') ? 'text-red-800  border-b-2 border-red-800 hover:text-yellow-700' : 'text-gray-900 hover:text-yellow-700' }}">
                            Home
                        </a>
                    
                        <a href="{{ route('User.katalog') }}"
                           class="font-bold {{ request()->routeIs('User.katalog', 'User.detailProduct') ? 'text-red-800  border-b-2 border-red-800 hover:text-yellow-700' : 'text-gray-900 hover:text-yellow-700' }}">
                            {{ request()->routeIs('User.detailProduct') ? 'Produk' : 'Katalog' }}
                        </a>
                    
                        <a href="{{ route('User.Checkout') }}"
                           class="font-bold {{ request()->routeIs('User.Checkout') ? 'text-red-800  border-b-2 border-red-800 hover:text-yellow-700' : 'text-gray-900 hover:text-yellow-700' }}">
                            Shopping
                        </a>
                    </nav>
                    
                </div>
                
                <button
                    @click="open = !open"
                    type="button"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-yellow-700"
                >
                    <i class="fa-solid fa-bars fa-lg"></i>
                </button>

                
                <div class="flex items-center gap-3 sm:gap-4">
                   {{-- wishlist --}}     
                   <a href="{{route('User.CartWishlist')}}" class="relative p-2 text-gray-600 hover:text-yellow-700">
                       <i class="fa-solid fa-heart"></i>

                    @if ($wishlistCount > 0)
                       <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs 
                        w-5 h-5 flex items-center justify-center rounded-full">{{$wishlistCount}}
                       </span>
                    @endif
                   </a>
                  
                    {{-- keranjang belanja --}}
                    <a href="{{route('User.CartShopping')}}" class="relative p-2 text-gray-600 hover:text-yellow-700 ">
                        <i class="fa-solid fa-cart-shopping"></i>
                    @if ($cartCount > 0)
                        
                    <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs 
                    w-5 h-5 flex items-center justify-center rounded-full">{{$cartCount}}
                    </span>
                    @endif
                    </a>
                    @guest
                    
                    @if (Route::has('login')) 
                    <a href="{{route('login')}}" class= "text-xs sm:text-sm font-medium text-white bg-primary-custom py-1.5 sm:py-2 px-3 sm:px-4 rounded-full">Login</a>
                    @endif
    
                    @if (Route::has('register'))
                    <a href="{{route('register')}}" class="text-xs sm:text-sm font-medium text-white bg-primary-custom py-1.5 sm:py-2 px-3 sm:px-4 rounded-full">Register</a>
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

        {{-- Menu Mobile --}}
        <div
        x-show="open"
        x-transition
        @click.outside="open = false"
        class="md:hidden mt-2 px-4 pb-4"
        >
        <nav class="flex flex-col space-y-3">
            <a href="{{ route('landingpage') }}"
            class="text-gray-900 hover:text-yellow-700 font-medium">
                Home
            </a>

            <a href="{{ route('User.katalog') }}"
            class="text-gray-900 hover:text-yellow-700 font-medium">
                @if (request()->routeIs('User.detailProduct'))
                    Produk
                @else
                    Katalog
                @endif
            </a>

            <a href="{{ route('User.Checkout') }}"
            class="text-gray-900 hover:text-yellow-700 font-medium">
                Shopping
            </a>
        </nav>
        </div>

    </header>
</div>


