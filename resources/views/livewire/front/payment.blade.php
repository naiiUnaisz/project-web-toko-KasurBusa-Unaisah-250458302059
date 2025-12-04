<div>
    <!-- Container utama untuk tampilan checkout -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        <!-- Notifikasi Livewire (Sukses/Warning/Error) -->
        @if (session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg" role="alert">
                <span class="font-medium">Perhatian!</span> {{ session('warning') }}
            </div>
        @endif
        @if (session()->has('error'))
            <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
                <span class="font-medium">Gagal!</span> {{ session('error') }}
            </div>
        @endif
        
        <h1 class="text-4xl font-extrabold text-gray-900 mb-8 text-center border-b pb-4">
            <!-- Asumsi fa-solid fa-credit-card tersedia melalui FontAwesome -->
            <i class="fa-solid fa-credit-card text-primary-custom mr-3"></i>
            Proses Pembayaran & Konfirmasi
        </h1>

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 space-y-8">
            
            <!-- Langkah 1: Alamat Pengiriman -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">1. Alamat Pengiriman</h2>
                <div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Input Nama Penerima -->
                        <div>
                            <input type="text" placeholder="Nama Penerima Lengkap" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" 
                                wire:model.defer="recipientName" required>
                            @error('recipientName') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        
                        <!-- Input Nomor Telepon -->
                        <div>
                            <input type="tel" placeholder="Nomor Telepon (mis: 0812xxxx)" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" 
                                wire:model.defer="recipientPhone" required>
                            @error('recipientPhone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <!-- Input Alamat Lengkap -->
                        <textarea placeholder="Alamat Lengkap (Jalan, Nomor Rumah, RT/RW, Kecamatan, Kota)" rows="3" 
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-primary-custom focus:border-primary-custom" 
                                wire:model.defer="deliveryAddress" required></textarea>
                        @error('deliveryAddress') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="mt-4 flex items-center">
                        <!-- Saran: Tambahkan info Wilayah/Kode Pos jika diperlukan -->
                        <i class="fa-solid fa-map-pin text-gray-500 mr-2"></i> 
                        <p class="text-sm text-gray-500">Pastikan alamat Anda benar dan lengkap untuk pengiriman yang cepat.</p>
                    </div>
                </div>
            </div>
            
            <!-- Langkah 2: Opsi Pengiriman -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">2. Opsi Pengiriman</h2>
                <div class="space-y-3">
                    
                    <!-- Opsi Kurir Toko (GRATIS) -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border transition-colors 
                                @if($shippingMethod === 'store_courier') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="shipping_method" value="store_courier" 
                                wire:model="shippingMethod" class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">Kurir Toko (Area Cileungsi & Sekitarnya)</p>
                                <p class="text-sm text-gray-500">Estimasi 1-2 hari kerja.</p>
                            </div>
                            <span class="font-bold text-green-600">GRATIS</span>
                        </div>
                    </label>
                    
                    <!-- Opsi Reguler (Berbayar) -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border transition-colors
                                @if($shippingMethod === 'regular') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="shipping_method" value="regular" 
                                wire:model="shippingMethod" class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">JNE / J&T</p>
                                <p class="text-sm text-gray-500">Estimasi 3-5 hari kerja (Tergantung lokasi).</p>
                            </div>
                            <!-- Perbaikan: Tambahkan Livewire format Rupiah secara langsung -->
                            <span class="font-bold text-red-600">
                                {{ $regularShippingCost > 0 ? 'Rp ' . number_format($regularShippingCost, 0, ',', '.') : 'Hitung...' }}
                            </span>
                        </div>
                    </label>
                    @error('shippingMethod') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Langkah 3: Metode Pembayaran -->
            <div class="border-b pb-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">3. Metode Pembayaran</h2>
                <div class="space-y-3">
                    
                    <!-- Opsi 1: Transfer Bank (BCA) -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border transition-colors
                                @if($paymentMethod === 'transfer') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="payment_method" value="transfer" 
                                wire:model="paymentMethod" class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Transfer Bank (BCA)</p>
                            <p class="text-sm text-gray-500">Pembayaran ke Rekening Resmi Toko Kasur</p>
                        </div>
                    </label>

                    <!-- Opsi 2: QRIS -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border transition-colors
                                @if($paymentMethod === 'QRIS') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="payment_method" value="QRIS" 
                                wire:model="paymentMethod" class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Pembayaran via QRIS</p>
                            <p class="text-sm text-gray-500">Scan kode QR dari aplikasi pembayaran Anda.</p>
                        </div>
                    </label>
                    
                    <!-- Opsi 3: COD -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border transition-colors
                                @if($paymentMethod === 'cod') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif
                
                                @if($orderTotal > 5000000) opacity-50 cursor-not-allowed hover:border-gray-200 @endif">
                        <input type="radio" name="payment_method" value="cod" 
                                wire:model="paymentMethod" 
                                @if($orderTotal > 5000000) disabled @endif
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom disabled:opacity-50">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Bayar di Tempat (COD)</p>
                            <p class="text-sm text-gray-500">Hanya berlaku untuk total pesanan di bawah **Rp 5.000.000**.</p>
                            @if($orderTotal > 5000000)
                                <p class="text-xs text-red-500 mt-1 font-medium">Pesanan melebihi batas COD.</p>
                            @endif
                        </div>
                    </label>
                    @error('paymentMethod') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Detail Rekening/Instruksi (Tampil jika Transfer atau QRIS dipilih) -->
                @if(in_array($paymentMethod, ['transfer', 'QRIS']))
                    <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 rounded-lg shadow-sm">
                        <p class="font-semibold text-lg mb-2">Instruksi Pembayaran</p>
                        @if($paymentMethod === 'transfer')
                            <!-- Perbaikan: Gunakan properti yang pasti ada di Livewire, dan tambahkan tombol salin -->
                            <p class="text-sm">Bank: **BCA**</p>
                            <div class="flex items-center justify-between bg-white p-2 rounded mt-1 border">
                                <p class="text-sm font-mono tracking-wider">No. Rekening: **123-456-7890**</p>
                                <button type="button" onclick="navigator.clipboard.writeText('1234567890').then(() => alert('Nomor Rekening berhasil disalin!')).catch(err => console.error('Gagal menyalin:', err));" 
                                    class="text-primary-custom hover:text-primary-dark text-xs font-bold transition">
                                    <i class="fa-solid fa-copy"></i> Salin
                                </button>
                            </div>
                            <p class="text-sm mt-1">Atas Nama: **[Nama Pemilik Rekening]**</p>
                            <p class="mt-3 text-xs italic">Mohon transfer sesuai jumlah Total Akhir Pesanan.</p>
                        @elseif($paymentMethod === 'QRIS')
                            <p class="text-sm">Silakan siapkan aplikasi pembayaran Anda (Gopay/OVO/Dana/dll).</p>
                            <p class="text-sm">Anda akan melihat kode QR setelah menekan tombol **Lakukan Pembayaran**.</p>
                            <p class="mt-3 text-xs italic">Pembayaran melalui QRIS mungkin dikenakan biaya layanan oleh penyedia.</p>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Langkah 4 & 5: Konfirmasi Pesanan, Total, dan Unggah Bukti Bayar -->
            <div class="pt-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">4. Rincian Biaya & Konfirmasi</h2>

                <!-- Ringkasan Total Biaya Detail -->
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between items-center text-gray-600">
                        <span class="text-lg">Total Produk</span>
                        <span class="text-lg font-semibold">{{ 'Rp ' . number_format($baseTotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center text-gray-600">
                        <span class="text-lg">Biaya Pengiriman</span>
                        <!-- Perbaikan: Gunakan kondisi untuk menampilkan GRATIS atau biaya -->
                        <span class="text-lg font-semibold">
                            @if($shippingMethod === 'store_courier')
                                <span class="text-green-600">GRATIS</span>
                            @else
                                {{ 'Rp ' . number_format($shippingCost, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                </div>
                
                <!-- Ringkasan Total Akhir -->
                <div class="flex justify-between items-center bg-primary-custom/10 p-4 rounded-xl mb-6 border border-primary-custom shadow-inner">
                    <span class="text-xl font-bold text-gray-900">TOTAL AKHIR PESANAN</span>
                    <!-- Menampilkan Total Akhir yang sudah dihitung -->
                    <span class="text-3xl font-extrabold text-primary-custom">{{ 'Rp ' . number_format($orderTotal, 0, ',', '.') }}</span>
                </div>

                <!-- Bagian 5. Unggah Bukti Bayar (KHUSUS Transfer/QRIS) -->
                @if(in_array($paymentMethod, ['transfer', 'QRIS']))
                    <div class="mb-6 p-4 border border-dashed border-gray-400 rounded-lg bg-gray-50 shadow-sm">
                        <h3 class="text-xl font-bold text-primary-custom mb-3 flex items-center">
                            <!-- Asumsi fa-solid fa-cloud-arrow-up tersedia melalui FontAwesome -->
                            <i class="fa-solid fa-cloud-arrow-up w-6 h-6 mr-2"></i> 5. Unggah Bukti Bayar
                        </h3>
                        
                        <!-- Input file untuk upload bukti bayar -->
                        <input type="file" 
                                wire:model="paymentProof"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-custom/10 file:text-primary-custom hover:file:bg-primary-custom/20">
                        
                        @error('paymentProof') 
                            <span class="text-red-500 text-sm mt-2 block font-medium">{{ $message }}</span> 
                        @enderror
                        
                        @if ($paymentProof)
                            <!-- Menampilkan nama file untuk konfirmasi upload -->
                            <p class="mt-2 text-xs text-green-700 font-medium">
                                File terpilih: {{ $paymentProof->getClientOriginalName() }}
                            </p>
                            <!-- Tambahkan Pratinjau Gambar jika itu adalah file gambar (opsional, tergantung Livewire) -->
                            <!-- Jika $paymentProof adalah instance UploadedFile, Anda bisa menggunakan $paymentProof->temporaryUrl() -->
                            {{-- <img src="{{ $paymentProof->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded-lg border" /> --}}
                        @endif

                        <!-- Loading State saat upload -->
                        <div wire:loading wire:target="paymentProof" class="mt-2 text-sm text-blue-500 flex items-center">
                            <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Memproses file...
                        </div>
                    </div>
                @endif
                
                <!-- Tombol Lakukan Pembayaran -->
                <button wire:click.prevent="placeOrder" 
                        wire:loading.attr="disabled"
                        wire:target="placeOrder, paymentProof"
                        class="w-full bg-primary-custom text-white py-4 rounded-full font-bold text-xl transition-colors hover:bg-primary-dark shadow-xl disabled:opacity-50 disabled:cursor-not-allowed">
                    <span wire:loading.remove wire:target="placeOrder, paymentProof">
                        <i class="fa-solid fa-lock mr-2"></i>
                        Lakukan Pembayaran
                    </span>
                    <span wire:loading wire:target="placeOrder, paymentProof">
                        <i class="fa-solid fa-spinner fa-spin mr-2"></i>
                        Memproses Pesanan...
                    </span>
                </button>
            </div>

        </div>
    </main>
</div>