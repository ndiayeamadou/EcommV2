<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Order;
use Carbon\Carbon;
use Livewire\Component;

class UserDashboard extends Component
{
    public $orders;

    public function mount ()
    {
        $this->orders = Order::with('orderItems')->get();
    }
    public function render()
    {
        $totalOrders = Order::where('user_id', auth()->user()->id)->count();

        $todayDate  = Carbon::now()->format('Y-m-d');
        $thisMonth = Carbon::now()->format('m');
        $thisYear   = Carbon::now()->format('Y');

        $todayOrder = Order::whereDate('created_at', $todayDate)->where('user_id', auth()->user()->id)->count();
        $thisMonthOrder = Order::whereDate('created_at', $thisMonth)->where('user_id', auth()->user()->id)->count();
        $thisYearOrder = Order::whereDate('created_at', $thisYear)->where('user_id', auth()->user()->id)->count();

        return view('livewire.admin.dashboard.user-dashboard',[
            'totalOrders'=> $totalOrders,
            'todayOrder'=> $todayOrder,
            'thisMonthOrder'=> $thisMonthOrder,
            'thisYearOrder'=> $thisYearOrder,
        ]);
    }
}
