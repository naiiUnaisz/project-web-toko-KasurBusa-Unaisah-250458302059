<div>

    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 min-h-screen">
        {{-- Notifikasi Livewire (Sukses/Warning/Error)  --}}
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
        
        <h1 class="text-4xl font-extrabold mb-8 text-center border-b pb-4">
            <i class="fa-solid fa-credit-card text-primary-custom mr-3"></i>
            Proses Pembayaran & Konfirmasi
        </h1>

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 space-y-8">
            <div>
                <h2 class="text-xl font-bold text-primary-custom mb-4">
                    <i class="fa-solid fa-location-dot text-primary-custom"></i>
                    Alamat Pengiriman
                </h2>
            </div>

                {{-- Alamat Pengiriman --}}
            @if($selectedAddressId)
            <div class="p-4 border rounded-lg bg-gray-50 mb-4">
                <p class="font-bold">{{ $recipientName }} ({{ $recipientPhone }})</p>
                <p class="text-sm">{{ $deliveryAddress }}</p>
                <button wire:click="openAddressModal" class="text-blue-500 underline">
                    Ubah Alamat
                </button>
            </div>
            @else
            <button wire:click="openModal" 
                    class="px-4 py-2 bg-red-700 text-white rounded-lg hover:bg-yellow-500 shadow-md">
                + Masukkan Alamat
            </button>
            @endif

        
            {{-- opsi pengiriman --}}
            <div class="border-b pb-6">
                <h4 class="italic text-slate-700 mb-4">Pilih Opsi Pengiriman</h4>
                <div class="space-y-3">
                    
                    {{-- Opsi Kurir Toko --}}
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border 
                                @if($shippingMethod === 'store_courier') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="shipping_method" value="store_courier" 
                                wire:model="shippingMethod" 
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">

                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">Kurir Toko (Area Cileungsi & Sekitarnya)</p>
                            </div>
                            <span class="font-bold text-green-600">GRATIS</span>
                        </div>
                    </label>
                    
                    {{-- Metode Pembayaran --}}
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border 
                                @if($shippingMethod === 'regular') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="shipping_method" value="regular" 
                                wire:model="shippingMethod" 
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4 flex justify-between w-full items-center">
                            <div>
                                <p class="font-semibold text-gray-900">Dakota / J&T</p>
                                <p class="text-sm text-gray-500">Estimasi 3-5 hari kerja (Tergantung lokasi).</p>
                            </div>
                        
                            <span class="font-bold text-red-600">
                                {{ $regularShippingCost > 0 ? 'Rp ' . number_format($regularShippingCost, 0, ',', '.') : 'Hitung...' }}
                            </span>
                        </div>
                    </label>
                    @error('shippingMethod') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

         {{-- Metode Pembayaran --}}
            <div class="border-b pb-6">
                <h4 class="italic text-slate-700 mb-4">Metode Pembayaran</h4>
                <div class="space-y-3">
                    
                   {{-- Opsi tf --}}
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border 
                                @if($paymentMethod === 'transfer') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="payment_method" value="transfer" 
                                wire:model="paymentMethod" 
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Transfer Bank (BSI)</p>
                            <p class="text-sm text-gray-500">Pembayaran ke Rekening Toko Kasur</p>
                        </div>
                    </label>

                    <!-- Opsi QRIS -->
                    {{-- <label class="flex items-center p-4 rounded-lg cursor-pointer border
                                @if($paymentMethod === 'QRIS') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif">
                        <input type="radio" name="payment_method" value="QRIS" 
                                wire:model="paymentMethod" 
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Pembayaran via QRIS</p>
                            <p class="text-sm text-gray-500">Scan kode QR dari aplikasi anda</p>
                        </div>
                    </label> --}}
                    
                    <!-- Opsi COD -->
                    <label class="flex items-center p-4 rounded-lg cursor-pointer border
                                @if($paymentMethod === 'cod') border-primary-custom bg-primary-custom/10 shadow-md 
                                @else border-gray-200 hover:border-gray-400 bg-white 
                                @endif
                
                                @if($orderTotal > 5000000) opacity-50 cursor-not-allowed hover:border-gray-200 @endif">
                            <input type="radio" name="payment_method" value="cod" 
                                wire:model="paymentMethod" 
                                @if($orderTotal > 5000000) disabled @endif
                                class="form-radio text-primary-custom h-5 w-5 focus:ring-primary-custom disabled:opacity-50
                            ">
                        <div class="ml-4">
                            <p class="font-semibold text-gray-900">Bayar di Tempat (COD)</p>
                            <p class="text-sm text-gray-500">Hanya berlaku untuk total pesanan di bawah *Rp 5.000.000*.</p>
                            @if($orderTotal > 5000000)
                                <p class="text-xs text-red-500 mt-1 font-medium">Pesanan melebihi batas COD.</p>
                            @endif
                        </div>
                </label>
                    @error('paymentMethod') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

               {{-- Detail Rekening jika dipilih --}}
                {{-- @if(in_array($paymentMethod, ['transfer', 'QRIS'])) --}}
                    <div class="mt-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 rounded-lg shadow-sm">
                        <p class="font-semibold text-lg mb-2">Instruksi Pembayaran</p>
                        @if($paymentMethod === 'transfer')
                            <p class="text-sm">Bank: BSI</p>
                            <div class="flex items-center justify-between bg-white p-2 rounded mt-1 border">
                                <p class="text-sm font-mono tracking-wider">No. Rekening: *123-456-7890*</p>
                                <button type="button" onclick="navigator.clipboard.writeText('1234567890').then(() => alert('Nomor Rekening berhasil disalin!')).catch(err => console.error('Gagal menyalin:', err));" 
                                    class="text-primary-custom hover:text-primary-dark text-xs font-bold">
                                    <i class="fa-solid fa-copy"></i> Salin
                                </button>
                            </div>
                            <p class="text-sm mt-1">Atas Nama: Toko Kasur</p>
                            <p class="mt-3 text-xs italic">Mohon transfer sesuai jumlah Total Akhir Pesanan.</p>
                        {{-- @elseif($paymentMethod === 'QRIS')
                            <p class="text-sm">Silakan siapkan aplikasi pembayaran Anda (Gopay/OVO/Dana/dll).</p>
                            <p class="text-sm">Anda akan melihat kode QR setelah menekan tombol **Lakukan Pembayaran**.</p>
                            <p class="mt-3 text-xs italic">Pembayaran melalui QRIS mungkin dikenakan biaya layanan oleh penyedia.</p>
                        @endif --}}
                    </div>
                @endif
            </div>

            {{-- konfirmasi pesanan &unggah bukti bayar --}}
            <div class="pt-6">
                <h2 class="text-2xl font-bold text-primary-custom mb-4">Rincian Biaya & Konfirmasi</h2>

                {{-- Ringkasan total biaya --}}
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between items-center text-gray-600">
                        <span class="text-lg">Total Produk</span>
                        <span class="text-lg font-semibold">{{ 'Rp ' . number_format($baseTotal, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center text-gray-600">
                        <span class="text-lg">Biaya Pengiriman</span>
                        <span class="text-lg font-semibold">
                            @if($shippingMethod === 'store_courier')
                                <span class="text-green-600">GRATIS</span>
                            @else
                                {{ 'Rp ' . number_format($shippingCost, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                </div>
                
                {{-- Total akhir --}}
                <div class="flex justify-between items-center bg-primary-custom/10 p-4 rounded-xl mb-6 border border-primary-custom shadow-md">
                    <span class="text-xl font-bold text-gray-900">TOTAL AKHIR PESANAN</span>

                   {{-- Total akhir yg sudah dihitung --}}
                    <span class="text-3xl font-extrabold text-primary-custom">{{ 'Rp ' . number_format($orderTotal, 0, ',', '.') }}</span>
                </div>

                {{-- nama pengirim --}}
                @if(in_array($paymentMethod, ['transfer', 'QRIS']))

                <div class="mb-6">
                    @if($paymentMethod === 'transfer')
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Nama Pengirim Rekening
                            </label>
                            <input type="text" 
                                wire:model="accountName" 
                                class="w-full p-2 border rounded-lg" 
                                placeholder="Masukkan Nama Pemilik Rekening">
                            @error('accountName') 
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif
                </div>

                {{-- unggah bukti bayar --}}
                    <div class="mb-6 p-4 border border-dashed border-gray-400 rounded-lg bg-gray-50 shadow-sm">
                        <h3 class="text-xl font-bold text-primary-custom mb-3 flex items-center">
                            <i class="fa-solid fa-cloud-arrow-up w-6 h-6 mr-2"></i> Unggah Bukti Bayar
                        </h3>
                        
                        {{-- inputnya --}}
                        <input type="file" 
                                wire:model="paymentProof"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-custom/10 file:text-primary-custom hover:file:bg-primary-custom/20">
                        
                        @error('paymentProof') 
                            <span class="text-red-500 text-sm mt-2 block font-medium">{{ $message }}</span> 
                        @enderror
                        
                        @if ($paymentProof)
                            <p class="mt-2 text-xs text-green-700 font-medium">
                                File terpilih: {{ $paymentProof->getClientOriginalName() }}
                            </p>
                            <img src="{{ $paymentProof->temporaryUrl() }}" class="mt-2 w-32 h-32 object-cover rounded-lg border" />
                        @endif

                        {{-- loading state saat upload --}}
                        <div wire:loading wire:target="paymentProof" class="mt-2 text-sm text-blue-500 flex items-center">
                            <i class="fa-solid fa-circle-notch fa-spin mr-2"></i> Memproses file...
                        </div>
                    </div>
                @endif
                
                {{-- tombol lakukan pembayaran --}}
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

    {{-- Modal Tambah Alamat --}}
    @if($isModalOpen)
    <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-xl">
    
            <h2 class="text-2xl font-bold mb-4 text-primary-custom">Tambah Alamat Baru</h2>
    
            <div class="space-y-3">
    
                <input 
                    type="text" 
                    wire:model="address_label"
                    class="w-full p-2 border rounded"
                    placeholder="Label Alamat (Rumah, Kantor, dll)">
    
                <input 
                    type="text" 
                    wire:model="recipient_name"
                    class="w-full p-2 border rounded"
                    placeholder="Nama Penerima">
    
                <input 
                    type="text" 
                    wire:model="phone_number"
                    class="w-full p-2 border rounded"
                    placeholder="Nomor HP">
    
                <textarea 
                    wire:model="address_line"
                    class="w-full p-2 border rounded"
                    placeholder="Detail Alamat">
                </textarea>
    
                <input 
                    type="text" wire:model="city"
                    class="w-full p-2 border rounded"
                    placeholder="Kota">
    
                <input 
                    type="text" 
                    wire:model="province"
                    class="w-full p-2 border rounded"
                    placeholder="Provinsi">
    
                <input 
                    type="text" 
                    wire:model="postal_code"
                    class="w-full p-2 border rounded"
                    placeholder="Kode Pos">
            </div>
    
            <div class="flex justify-end mt-4 gap-3">
                <button wire:click="closeModal"
                    class="px-4 py-2 bg-gray-300 rounded">
                    Batal
                </button>
    
                <button wire:click="saveAddress"
                    class="px-4 py-2 bg-primary-custom text-white rounded">
                    Simpan
                </button>
            </div>
    
        </div>
    </div>
    @endif
    
    {{-- modal pilih alamat --}}

    @if($showAddressModal)
<div class="fixed inset-0 bg-black/50 flex justify-center items-center z-50">
    <div class="bg-white p-4 rounded-xl shadow-xl w-96">

        <h3 class="font-semibold mb-3 text-lg">Alamat Saya</h3>

        @foreach($addresses as $address)
        <div 
        class="border rounded-lg px-4 py-3 mb-3 cursor-pointer hover:border-blue-500 transition relative 
               @if($selectedAddressId == $address->id) border-blue-600 
               @else border-gray-300 
               @endif"
        wire:click="applyAddress({{ $address->id }})"
    >
        <!-- RADIO BUTTON -->
        <div class="absolute left-3 top-1/2 -translate-y-1/2">
            <input 
                type="radio" 
                name="selectedAddress" 
                value="{{ $address->id }}" 
                class="h-4 w-4 cursor-pointer"
                @checked($selectedAddressId == $address->id)
            >
        </div>
    
        <div class="pl-8">
            <div class="flex items-center gap-2">
                <h3 class="font-semibold text-gray-800">{{ $address->recipient_name }}</h3>
    
                @if($address->is_default)
                    <span class="bg-blue-600 text-white text-xs px-2 py-0.5 rounded">
                        Utama
                    </span>
                @endif
            </div>
    
            <div class="text-sm text-gray-600">{{ $address->phone_number }}</div>
    
            <div class="text-sm text-gray-700 mt-1 leading-5">
                {{ $address->address_label }} — {{ $address->address_line }},
                {{ $address->city }}, {{ $address->province }}, {{ $address->postal_code }}
            </div>
    
            <div class="flex gap-4 mt-3 text-sm font-medium">
                <button wire:click.stop="editAddress({{ $address->id }})" class="text-blue-600 hover:underline">Ubah</button>
                <button wire:click.stop="deleteAddress({{ $address->id }})" class="text-red-600 hover:underline">Hapus</button>
            </div>
        </div>
    </div>
        @endforeach

        <button wire:click="openAddAddressForm" class="mt-2 text-primary-custom font-medium">
            + Tambah Alamat Baru
        </button>

        <div class="flex justify-end mt-4">
            <button wire:click="closeAddressModal" 
                class="px-4 py-2 bg-gray-300 rounded">
                Tutup
            </button>
        </div>

    </div>
</div>
@endif

</div>