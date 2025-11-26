<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>|| Busa Cileungsi</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('Frontend/landingPage_TokoKasur/style.css')}}">

    <link rel="shortcut icon" href="{{asset ('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}" type="image/x-icon">

 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    @livewireStyles
</head>
<body>

    @if (Request::is('/') || Request::is('home'))
        @include('partials.header-landing')
    @else
        @include('partials.header-katalog')
    @endif

   {{$slot}}

      <!-- BLOK 6: FOOTER -->
      <footer class="bg-[#1B1717] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Kolom 1: Logo & Deskripsi -->
                <div>
                    <div class="flex items-center justify-center w-40 rounded-lg p-2 shadow-md" style="background-color: rgb(239, 218, 218)">
                        <img
                          src="{{asset("Frontend/landingPage_TokoKasur/img/logo_buscil.png")}}"
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
    <a href="https://wa.me/6283890909067?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20kasur%20Anda." target="_blank" class="whatsapp-float fixed bottom-6 right-6 p-4 rounded-full shadow-xl text-white z-50">
        <div class="flex items-center space-x-2">
            <i class="fa-brands fa-whatsapp" ></i>
            <span class="font-semibold hidden md:inline">Chat via WhatsApp</span>
        </div>
    </a>
  
    @livewireScripts 
    
</body>
</html>
