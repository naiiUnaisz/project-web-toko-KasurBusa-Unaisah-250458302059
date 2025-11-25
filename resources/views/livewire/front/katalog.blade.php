@extends('layouts.landingPage')
@section('katalog')

<div>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Semua Produk Kasur</h1>

        <!--  SIDEBAR FILTER  -->
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- SIDEBAR FILTER (Fitur 2) -->
            <aside class="w-full lg:w-64 bg-white p-6 rounded-xl shadow-lg flex-shrink-0">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Filter Berlapis</h2>
                <form id="filter-form">
                    
                    <!-- Filter Merek -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-700 mb-2">Merek</h3>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="merek" value="Brand A" class="rounded text-primary-custom filter-checkbox"> <span>Brand A</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="merek" value="Brand B" class="rounded text-primary-custom filter-checkbox"> <span>Brand B</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="merek" value="Brand C" class="rounded text-primary-custom filter-checkbox"> <span>Brand C</span></label>
                    </div>

                    <!-- Filter Jenis Busa -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-700 mb-2">Jenis Busa</h3>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="busa" value="Memory Foam" class="rounded text-primary-custom filter-checkbox"> <span>Memory Foam</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="busa" value="Latex" class="rounded text-primary-custom filter-checkbox"> <span>Latex</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="busa" value="Springbed" class="rounded text-primary-custom filter-checkbox"> <span>Springbed</span></label>
                    </div>

                    <!-- Filter Ukuran -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-700 mb-2">Ukuran</h3>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="ukuran" value="Single" class="rounded text-primary-custom filter-checkbox"> <span>Single (90x200)</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="ukuran" value="Queen" class="rounded text-primary-custom filter-checkbox"> <span>Queen (160x200)</span></label>
                        <label class="flex items-center space-x-2 text-sm text-gray-600"><input type="checkbox" name="ukuran" value="King" class="rounded text-primary-custom filter-checkbox"> <span>King (180x200)</span></label>
                    </div>

                    <!-- Filter Rentang Harga -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-700 mb-2">Rentang Harga</h3>
                        <input type="range" id="price-range" min="500000" max="15000000" value="15000000" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer range-xl">
                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Rp 500rb</span>
                            <span id="price-value">Rp 15.000.000</span>
                        </div>
                    </div>

                    <button type="button" id="apply-filters" class="w-full bg-primary-custom text-white py-2 rounded-lg font-semibold bg-primary-custom:hover transition duration-150">Terapkan Filter</button>
                </form>
            </aside>

            <!-- AREA HASIL PRODUK -->
            <section class="flex-grow">
                <!-- Sorting Produk (dan Statistik -->
                <div class="flex justify-between items-center mb-6 p-4 bg-white rounded-lg shadow-md">
                    <p id="product-count" class="text-gray-600 text-sm">Menampilkan 0 produk</p>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-medium text-gray-700">Urutkan Berdasarkan:</span>
                        <select id="sort-select" class="border border-gray-300 rounded-lg p-2 text-sm focus:ring-primary-500 focus:border-primary-500">
                            <option value="default">all</option>
                            <option value="default">Paling Relevan</option>
                            <option value="price-asc">Harga Termurah</option>
                            <option value="price-desc">Harga Termahal</option>
                        </select>
                    </div>
                </div>

                <!-- Daftar Kartu Produk (Hasil Pencarian/Filter) -->
                <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    
                    <div class="text-center p-10 text-gray-500 bg-white rounded-xl shadow-lg col-span-full">
                        <i data-lucide="package-search" class="w-12 h-12 mx-auto mb-4 text-primary-custom"></i>
                        <p>Memuat produk...</p>
                    </div>
                </div>
            </section>
        </div>
    </main>
</div>

@endsection

