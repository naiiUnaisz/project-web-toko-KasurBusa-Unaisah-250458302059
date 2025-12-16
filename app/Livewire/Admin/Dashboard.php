<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{

    public $totalUsers;
    public $totalProducts;
    public $totalIncome;

    public function mount()
    {
        // total user
        $this->totalUsers = User::count();

        // total produk
        $this->totalProducts = Product::count();

        // total penghasilan dari order yang selesai
        $this->totalIncome = Order::where('status', 'completed')
            ->sum('total_amount');
    }

    public function render()
    {
        $ordersPerMonth = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        

    return view('livewire.admin.dashboard', compact('ordersPerMonth'));
    
    }

}
