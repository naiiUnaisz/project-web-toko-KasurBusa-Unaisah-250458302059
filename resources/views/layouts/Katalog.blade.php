{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Kasur - Landing Page Blueprint</title>
   
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{asset('Frontend/landingPage_TokoKasur/style.css')}}">

    <link rel="shortcut icon" href="{{asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png')}}" type="image/x-icon">

    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
   
</head>
<body class="bg-[#f4f4f4] text-gray-800">

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
                    <input type="search"
                    wire:model.live.debounce.300ms="search"
                    placeholder="Cari kasur di katalog..." 
                    class="w-full border border-gray-300 rounded-l-md px-4 py-2 text-sm focus:ring-primary-500 focus:border-primary-500">
                    <button class="bg-primary-custom text-white p-2 rounded-r-md transition duration-150 bg-primary-custom:hover">
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

  {{$slot}}
    
    <!-- FLOATING WHATSAPP CHAT-->
    <a href="https://wa.me/6283890909067?text=Halo%2C%20saya%20ingin%20bertanya%20tentang%20produk%20kasur%20Anda." target="_blank" class="whatsapp-float fixed bottom-6 right-6 p-4 rounded-full shadow-xl text-white z-50">
        <div class="flex items-center space-x-2">
            <i class="fa-brands fa-whatsapp" ></i>
            <span class="font-semibold hidden md:inline">Chat via WhatsApp</span>
        </div>
    </a>
    
    
</body>
</html> --}}