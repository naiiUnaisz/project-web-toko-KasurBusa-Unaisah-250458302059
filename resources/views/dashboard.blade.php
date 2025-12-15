<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="container mx-auto mt-8">

        @if(auth()->user()->role == 'admin')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Total Users</h3>
                    <p class="text-3xl">3</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4"> Total Pending</h3>
                    <p class="text-3xl">2</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Total Processing</h3>
                    <p class="text-3xl">1</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Total Shipped</h3>
                    <p class="text-3xl">4</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Total Complate</h3>
                    <p class="text-3xl">2</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold mb-4">Total Cancelled</h3>
                    <p class="text-3xl">1</p>
                </div>
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold">Selamat datang, {{ auth()->user()->name }}!</h3>
                <p class="mt-2 text-gray-600">Anda login sebagai user biasa.</p>
            </div>
        @endif

    </div>


</x-app-layout>
