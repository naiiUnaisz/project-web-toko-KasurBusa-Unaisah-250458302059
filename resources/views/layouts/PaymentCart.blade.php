<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| Busa Cileungsi</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/landingPage_TokoKasur/style.css')}}">>

    <link rel="shortcut icon" href="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}" type="image/x-icon">

 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   
</head>
<body class="bg-gray-50">

    <!-- HEADER (Disalin dari landing-page.blade.php) -->
    <header class="sticky top-0 bg-[#EEEBDD] shadow-md z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center justify-center w-40 rounded-lg p-2 shadow-md" style="background-color: rgb(239, 218, 218)">
                    <img src="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}" alt="logo" class="h-7 w-auto object-contain"/>
                </div>
                
                <!-- Pencarian  -->
                <div class="hidden md:flex flex-grow max-w-lg mx-10">
                    <input type="search" placeholder="Cari kasur, busa, atau merek..." class="w-full border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:ring-primary-custom focus:border-primary-custom">
                    <button class="bg-primary-custom text-white p-2 rounded-r-md transition-button">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                
                
                <div class="flex items-center space-x-4">
                    <!-- Wishlist  -->
                    <a href="{{route('User.CartWishlist')}}" class="text-gray-900 hover:text-primary-custom relative">
                        <i class="fa-regular fa-heart text-xl"></i>
                        {{-- <span class="absolute -top-1 -right-1.5 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">2</span> --}}
                    </a>
                    <!-- Keranjang  -->
                    <a href="{{route('User.CartShopping')}}" class="text-gray-900 hover:text-primary-custom relative">
                        <i class="fa-solid fa-cart-shopping text-xl"></i>
                        {{-- <span class="absolute -top-1 -right-1.5 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span> --}}
                    </a>
                    
                    <!-- Login / Register / Dashboard (Simulasi sudah login) -->
                    <div class="flex space-x-2">
                        <a href="{{route('User.katalog')}}" class="text-sm text-gray-700 hover:text-primary-custom transition duration-150 font-medium border border-gray-300 py-2 px-4 rounded-full">Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT: Checkout -->
    {{$slot}}

    <!-- FOOTER (Disalin dari landing-page.blade.php) -->
    <footer class="bg-[#1B1717] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Kolom 1: Logo & Deskripsi -->
                <div>
                    <div class="flex items-center justify-center w-40 rounded-lg p-2 shadow-md" style="background-color: rgb(239, 218, 218)">
                        <img
                          src="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}"
                          alt="logo"
                          class="h-7 w-auto object-contain"
                        />
                      </div>
                      <br>
                    <p class="text-sm text-gray-400">Spesialis kasur kualitas terbaik dengan berbagai varian ukuran dan busa</p>
                </div>
                <!-- Kolom 2: Tautan Cepat -->
                <div>
                    <h3 class="font-semibold text-base mb-4">Informasi</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
                <!-- Kolom 3: Produk & Akun -->
                <div>
                    <h3 class="font-semibold text-base mb-4">Akun Saya</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Katalog Produk</a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Keranjang Belanja</a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Riwayat Pesanan</a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Wishlist </a></li>
                    </ul>
                </div>
                <!-- Kolom 4: Kontak & Sosial (Fitur 10) -->
                <div>
                    <h3 class="font-semibold text-base mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Instagram : @busa_cileungsi </a></li>
                        <li><a href="#" class="hover:text-primary-custom transition duration-150">Telepon: +62 838 9090 9067</a></li>
                    </ul>
                    <div class="flex space-x-4 mt-4">
                        <i data-lucide="facebook" class="w-6 h-6 hover:text-primary-custom cursor-pointer"></i>
                        <i data-lucide="instagram" class="w-6 h-6 hover:text-primary-custom cursor-pointer"></i>
                        <i data-lucide="twitter" class="w-6 h-6 hover:text-primary-custom cursor-pointer"></i>
                    </div>
                </div>
            </div>
            <div class="mt-10 pt-6 border-t border-gray-700 text-center text-sm text-gray-400">
                &copy; 2024 KasurBusaCileungsi. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>
    
    <!-- FLOATING WHATSAPP CHAT -->
    <a href="https://wa.me/6283890909067?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20kasur%20Anda." target="_blank" 
       class="whatsapp-float fixed bottom-6 right-6 p-4 rounded-full shadow-xl text-white z-50 transition duration-300 transform hover:scale-105">
        <i class="fab fa-whatsapp text-2xl"></i>
    </a>
    
</body>
</html>