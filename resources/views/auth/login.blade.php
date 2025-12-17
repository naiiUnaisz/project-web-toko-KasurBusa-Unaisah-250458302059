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
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-2">
            <label for="email" class="block text-sm/6 font-medium text-gray-600 ">Email</label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
        </div>

        <!-- Password -->
        <div class="flex items-center justify-between pt-6">
            <label for="password" class="block text-sm/6 font-medium text-gray-600">Password</label>

            @if (Route::has('password.request'))
            <div class="text-sm">
                <a class="font-semibold text-red-800 hover:text-indigo-300" href="{{ route('password.request') }}">
                    {{ __('Lupa Password?') }}
                </a>
            </div>
            @endif
        </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
       

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

               {{-- Button --}}
            <button type="submit"
               class="w-full bg-red-700 text-white py-3 rounded-lg font-semibold hover:bg-red-800 transition">
               Login
           </button>

        <div class="flex items-center justify-end mt-4">
           
     
        <p class="text-sm text-center text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-700 font-semibold">
                Daftar
            </a>
        </p>
    </div>
    </form>
</div>
</div>

</x-guest-layout>
