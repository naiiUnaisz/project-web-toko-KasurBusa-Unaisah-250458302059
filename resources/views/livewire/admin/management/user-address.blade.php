<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Manajemen Alamat Pengiriman</h1>
    
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white shadow-lg rounded-xl p-4">
        <div class="flex justify-between items-center mb-4">
          
            <div class="w-1/3">
                <input type="text" wire:model.live="search" placeholder="Cari penerima, user, atau label..." class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50">
            </div>
            {{-- <button wire:click="openAddressModal()" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-150">Tambah Alamat Baru</button> --}}
        </div>
    
        <!-- Tabel Data Alamat -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                       
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik (User)</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Label Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kontak Penerima</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Detail Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kota</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode Pos</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($addresses as $address)
                        <tr>
                           
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-indigo-600">
                                {{ $address->user->name ?? 'N/A' }}
                            </td>
                           
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="font-medium text-gray-900">{{ $address->address_label }}</p>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full mt-1 
                                    {{ $address->is_default ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                    {{ $address->is_default ? 'Utama' : 'Sekunder' }}
                                </span>
                            </td>
    
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $address->recipient_name }}
                            </td>
    
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $address->phone_number }}
                            </td>
    
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <p class="font-light">{{ $address->address_line ?? $address->street }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    Provinsi: {{ $address->province }}
                                </p>
                            </td>
    
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $address->city }}
                            </td>
                            
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $address->postal_code }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium flex space-x-2 justify-center">
                                <button wire:click="openAddressModal({{ $address->id }})" class="text-indigo-600 hover:text-indigo-900 transition duration-150">Edit</button>
                                <button wire:click="deleteAddress({{ $address->id }})" 
                                        wire:confirm="Yakin ingin menghapus alamat ini? Ini akan permanen."
                                        class="text-red-600 hover:text-red-900 transition duration-150">Hapus</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-gray-500">Tidak ada alamat pengiriman yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <!-- Pagination -->
        <div class="mt-4">
            {{ $addresses->links() }}
        </div>
    </div>
    
    <!-- Modal create & edit -->
    @if ($showAddressModal)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 mx-4" @click.away="$wire.showAddressModal = false">
            <h3 class="text-2xl font-bold mb-4 text-gray-800">{{ $addressId ? 'Edit Alamat' : 'Tambah Alamat Baru' }}</h3>
            
            <form wire:submit.prevent="saveAddress">
                <div class="space-y-4">
                    <div>
                        <label for="address_label" class="block text-sm font-medium text-gray-700">Label Alamat</label>
                        <input type="text" wire:model="address_label" id="address_label" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('address_label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label for="recipient_name" class="block text-sm font-medium text-gray-700">Nama Penerima</label>
                        <input type="text" wire:model="recipient_name" id="recipient_name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('recipient_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" wire:model="phone_number" id="phone_number" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('phone_number') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div>
                        <label for="address_line" class="block text-sm font-medium text-gray-700">Detail Jalan/Alamat</label>
                        <textarea wire:model="address_line" id="address_line" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        @error('address_line') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
                            <input type="text" wire:model="city" id="city" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                            <input type="text" wire:model="province" id="province" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('province') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="postal_code" class="block text-sm font-medium text-gray-700">Kode Pos</label>
                            <input type="text" wire:model="postal_code" id="postal_code" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('postal_code') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
    
                    <div class="flex items-center">
                        <input id="is_default" type="checkbox" wire:model="is_default" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="is_default" class="ml-2 block text-sm text-gray-900">Jadikan Alamat Utama?</label>
                    </div>
                </div>
    
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="$set('showAddressModal', false)" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition duration-150">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-150">
                        Simpan Alamat
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
    
    
    </div>