
<x-guest-layout>
<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 shadow-current  ">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
    {{-- Logo --}}
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="{{ asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png') }}"
             class="mx-auto h-10 w-auto" alt="Logo">

        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-black">
            Daftar Sekarang
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="pb-6 mt-4">
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit"
               class="w-full bg-red-700 text-white py-3 rounded-lg font-semibold hover:bg-red-800 transition">
               Register
           </button>
        
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Sudah Terdaftar ?') }}
            </a>
        </div>
    </form>
</div>  
</div>  
</x-guest-layout>
