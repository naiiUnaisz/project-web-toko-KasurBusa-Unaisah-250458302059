<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
                {{-- Logo --}}
                <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                    <img src="{{ asset('Frontend/landingPage_TokoKasur/img/logo_buscil.png') }}"
                         class="mx-auto h-10 w-auto" alt="Logo">
    
                    <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-black">
                        Login ke Akun Anda
                    </h2>
                </div>

    <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
    <div class="mb-4 text-sm text-gray-600">
       Masukkan email anda untuk verifikasi
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <button type="submit"
               class="w-full bg-red-700 text-white py-3 rounded-lg font-semibold hover:bg-red-800 transition">
               Reset Password
           </button>
        </div>
    </form>
 </div>
 </div>
</x-guest-layout>
