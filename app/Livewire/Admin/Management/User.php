<?php

namespace App\Livewire\Admin\Management;

use App\Models\User as UserModel;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class User extends Component
{
    
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortAsc = false;
    
    // Detail Pengguna
    public $showDetailModal = false;
    public ?UserModel $selectedUser = null; 
  
    public $availableRoles = ['admin', 'Customer'];
    public $newRole = ''; 

    public function render()
    {
        $users = UserModel::query()
        ->when($this->search, function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        })
        ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
        ->paginate(10);

        return view('livewire.admin.management.user', [
            'users' => $users,
        ]);
    }


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function showUserDetail($userId)
    {
        $this->selectedUser = UserModel::findOrFail($userId);
        $this->newRole = $this->selectedUser->role; 
        $this->showDetailModal = true;
    }
    
    
    public function updateRole($userId)
    {
        $this->validate([
            'newRole' => 'required|in:admin,Customer',
        ]);
        
        $user = UserModel::findOrFail($userId);
        
        if ($user->role !== $this->newRole) {
            $user->role = $this->newRole;
            $user->save();
            
            if ($this->selectedUser && $this->selectedUser->id === $userId) {
                $this->selectedUser->role = $this->newRole;
            }
            
            session()->flash('success', 'Role untuk ' . $user->name . ' berhasil diubah menjadi ' . $this->newRole . '.');
        } else {
             session()->flash('success', 'Tidak ada perubahan role.');
        }

        $this->showDetailModal = false;
    }
   
}
