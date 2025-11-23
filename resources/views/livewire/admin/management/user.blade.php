<div class="p-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Manajemen Pengguna </h1>
    
    @if (session()->has('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="bg-white shadow-lg rounded-xl p-4">
        <div class="flex justify-between items-center mb-4">
            <!-- Pencarian -->
            <div class="w-1/3">
                <input type="text" wire:model.live="search" placeholder="Cari nama atau email pengguna..." class="form-input w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50">
            </div>
            {{-- <!-- Tombol untuk menuju Manajemen Alamat -->
            <a href="/admin/addresses" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-150">
                Kelola Semua Alamat
            </a> --}}
        </div>
    
        <!-- Tabel Data Pengguna -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bergabung</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button wire:click="showUserDetail({{ $user->id }})" class="text-indigo-600 hover:text-indigo-900 mx-2 transition duration-150">Detail</button>
                                {{-- <a href="/admin/addresses?search={{ $user->name }}" class="text-blue-600 hover:text-blue-900 mx-2 transition duration-150">Lihat Alamat</a> --}}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-500">Tidak ada pengguna yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    
        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
    
    <!-- Livewire Modal (Detail Pengguna & Role SAJA) -->
    @if ($showDetailModal && $selectedUser)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full z-50 flex justify-center items-center">
        <div class="relative bg-white rounded-xl shadow-2xl w-full max-w-lg p-6 mx-4" @click.away="$wire.showDetailModal = false">
            <h3 class="text-2xl font-bold mb-4 text-gray-800"> Detail Pengguna: {{ $selectedUser->name }}</h3>
            
            <div class="border-b pb-4 mb-4">
                <p><strong>Email:</strong> {{ $selectedUser->email }}</p>
                <p><strong>Bergabung Sejak:</strong> {{ $selectedUser->created_at->format('d F Y') }}</p>
            </div>
            
            <!-- Form Update Role -->
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                {{-- <h4 class="font-semibold mb-2 text-lg">Ganti Role Pengguna</h4>
                <form wire:submit.prevent="updateRole({{ $selectedUser->id }})" class="flex space-x-3 items-end">
                    <div class="flex-grow">
                        <label for="newRole" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                        <select wire:model.live="newRole" id="newRole" class="mt-1 form-select w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200/50">
                            @foreach ($availableRoles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
                            @endforeach
                        </select>
                        @error('newRole') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition duration-150 h-full">
                        Simpan
                    </button>
                </form> --}}
                <p class="text-sm mt-2 text-gray-500">Role saat ini: 
                    <span class="font-bold {{ $selectedUser->role === 'admin' ? 'text-indigo-600' : 'text-green-600' }}">
                        {{ $selectedUser->role }}
                    </span>
                </p>
            </div>
            <!-- End Form Update Role -->
    
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" wire:click="$set('showDetailModal', false)" class="px-4 py-2 bg-gray-200 rounded-lg text-gray-700 hover:bg-gray-300 transition duration-150">Tutup</button>
            </div>
        </div>
    </div>
    @endif
    
    
    </div>