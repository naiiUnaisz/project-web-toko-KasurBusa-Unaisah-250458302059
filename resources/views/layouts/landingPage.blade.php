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

   @include('partials.footer')
  
    @livewireScripts 
    
</body>
</html>
