<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| Busa Cileungsi</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('Frontend/landingPage_TokoKasur/style.css')}}">

    <link rel="shortcut icon" href="img/logo_buscil.png" type="image/x-icon">

 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @livewireStyles
</head>
<body class="text-gray-900">
    <header class="header-sticky">
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
                <!-- Navigasi -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-900 hover:text-primary-custom transition duration-150 font-medium">Home</a>
                    <a href="#" class="text-primary-custom hover:text-primary-custom transition duration-150 font-bold border-b-2 border-primary-custom">Produk</a>
                    <a href="#" class="text-gray-900 hover:text-primary-custom transition duration-150 font-medium">Tentang Kami</a>
                </nav>
                <!-- Ikon Kanan -->
                <div class="flex items-center space-x-4">
                    <a href="{{route('User.CartWishlist')}}" class="text-gray-900 hover:text-primary-custom relative">
                        <i class="fa-regular fa-heart"></i>
                    </a>
                    <a href="{{route('User.CartShopping')}}" class="text-gray-900 hover:text-primary-custom">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Konten Utama Detail Produk -->
   {{$slot}}

    <!-- Footer -->
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
    
    @livewireScripts
 
</body>
</html>