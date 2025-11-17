<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Jenis Busa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if (session('Update'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('Update') }}</span>
                        </div>
                    @endif

                    @if (session('Create'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('Create') }}</span>
                        </div>
                    @endif

                    @if (session('Delete'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('Delete') }}</span>
                        </div>
                    @endif
                    <form wire:submit="createFoamType" class="mb-6">
                        <div class="flex items-end space-x-2">
                            <div class="flex-grow">
                                <label for="name" class="block text-sm font-medium text-gray-700">Jenis Busa</label>
                                <input type="text" wire:model="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                    Simpan
                                </button>
                            </div>
                        </div>
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </form>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                              
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($FoamTypes as $item)
                            
                                <tr wire:key="{{ $item->id }}"> <td class="px-6 py-4 whitespace-nowrap">{{ $item->id }}</td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($editingTypeId === $item->id)
                                            <input type="text" wire:model="editingTypeName" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                            @error('editingTypeName')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        @else
                                            {{ $item->name }}
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        @if ($editingTypeId === $item->id)
                                            <button wire:click="updateFoamType" class="text-green-600 hover:text-green-900">Simpan</button>
                                            <button wire:click="cancelEditFoamType" class="text-gray-600 hover:text-gray-900 ml-2">Batal</button>
                                        @else
                                            <button wire:click="editFoamType({{ $item->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</button>
                                            <button wire:click="deleteFoamType({{ $item->id }})" 
                                                    wire:confirm="Yakin ingin menghapus Jenis Busa ini?"
                                                    class="text-red-600 hover:text-red-900 ml-2">
                                                Hapus
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


