<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Order;

class Dashboard extends Component
{
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

    public function qtyUsers(){
        
    }
}
