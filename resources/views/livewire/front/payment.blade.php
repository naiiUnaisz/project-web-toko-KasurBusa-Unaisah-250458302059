<div>
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
            <i class="fa-solid fa-credit-card text-primary-custom mr-3"></i>
            Proses Pembayaran
        </h1>

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 space-y-8">
            
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4"> Alamat Pengiriman</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="text" placeholder="Nama Penerima Lengkap" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" required>
                        <input type="tel" placeholder="Nomor Telepon (mis: 0812xxxx)" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" required>
                    </div>
                    <div class="mt-4">
                        <textarea placeholder="Alamat Lengkap (Jalan, Nomor Rumah, RT/RW, Kecamatan, Kota)" rows="3" class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" required></textarea>
                    </div>
                    <div class="mt-4 flex items-center">
                        <i data-lucide="map-pin" class="w-5 h-5 text-gray-500 mr-2"></i>
                        <p class="text-sm text-gray-500">Pastikan alamat Anda benar untuk menghindari keterlambatan.</p>
                    </div>
                </form>
            </div>
            
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">Opsi Pengiriman</h2>
                <div class="space-y-3">
           
                    <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer border border-primary-custom shadow-sm">
                        <input type="radio" name="shipping_method" value="store_courier" checked class="form-radio text-primary-custom h-5 w-5">
                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">Kurir Toko (Area Cileungsi & Sekitarnya)</p>
                                <p class="text-sm text-gray-500">Estimasi 1-2 hari kerja.</p>
                            </div>
                            <span class="font-bold text-green-600">GRATIS</span>
                        </div>
                    </label>
                    
                    <label class="flex items-center bg-white p-4 rounded-lg cursor-pointer border border-gray-200 hover:border-gray-400 transition-colors">
                        <input type="radio" name="shipping_method" value="regular" class="form-radio text-primary-custom h-5 w-5">
                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">JNE / Sicepat / J&T</p>
                                <p class="text-sm text-gray-500">Estimasi 3-5 hari kerja.</p>
                            </div>
                            <span class="font-bold text-red-600">Rp 75.000</span>
                        </div>
                    </label>

                </div>
            </div>

            <!-- Langkah 3: Metode Pembayaran -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">3. Metode Pembayaran</h2>
                <div class="space-y-3">
                    
                    <!-- Opsi 1: Transfer Bank (BCA) -->
                    <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer border border-primary-custom shadow-sm">
                        <input type="radio" name="payment_method" value="bank_transfer" checked class="form-radio text-primary-custom h-5 w-5">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Transfer Bank (BCA)</p>
                            <p class="text-sm text-gray-500">Pembayaran ke Rekening Resmi Toko Kasur</p>
                        </div>
                    </label>
                    
                    <!-- Opsi 2: COD (Cash on Delivery) -->
                    <label class="flex items-center bg-white p-4 rounded-lg cursor-pointer border border-gray-200 hover:border-gray-400 transition-colors">
                        <input type="radio" name="payment_method" value="cod" class="form-radio text-primary-custom h-5 w-5">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Bayar di Tempat (COD)</p>
                            <p class="text-sm text-gray-500">Hanya berlaku untuk total pesanan di bawah Rp 5 Juta.</p>
                        </div>
                    </label>

                </div>
            </div>
            
            <!-- Ringkasan Akhir dan Tombol Bayar -->
            <div class="pt-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">4. Konfirmasi Pesanan</h2>
                <div class="flex justify-between items-center bg-gray-100 p-4 rounded-lg mb-6 border border-gray-200">
                    <span class="text-xl font-bold text-gray-900">Total Akhir Pesanan</span>
                    <span class="text-3xl font-extrabold text-red-600">Rp 2.000.000</span>
                </div>
                
                <button class="w-full bg-primary-custom text-white py-4 rounded-full font-bold text-xl transition-button hover:bg-primary-dark shadow-2xl">
                    <i class="fa-solid fa-lock mr-2"></i>
                    Lakukan Pembayaran
                </button>
            </div>

        </div>
    </main>
</div>
