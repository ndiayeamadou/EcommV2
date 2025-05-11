<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AdminDashboard extends Component
{
    public $totalSales = 0;
    public $totalOrders = 0;
    public $totalCustomers = 0;
    public $lowStockProducts = 0;
    
    public $period = 'week';
    public $salesData = [];
    public $ordersData = [];
    
    public function mount()
    {
        $this->loadStats();
        $this->loadChartData();
    }
    
    public function loadStats()
    {
        // Get total sales for the selected period
        $query = Order::where('payment_status', 'paid');
        
        switch ($this->period) {
            case 'today':
                $query->whereDate('created_at', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
                break;
            case 'year':
                $query->whereYear('created_at', Carbon::now()->year);
                break;
        }
        
        $this->totalSales = $query->sum('total');
        $this->totalOrders = Order::count();
        $this->totalCustomers = User::whereHas('customer')->count();
        $this->lowStockProducts = Product::where('quantity', '<', 10)->count();
    }
    
    public function loadChartData()
    {
        // Get sales data for the last 7 days
        $startDate = Carbon::now()->subDays(6)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        
        $salesQuery = Order::where('payment_status', 'paid')
            ->where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date');
        
        $ordersQuery = Order::where('created_at', '>=', $startDate)
            ->where('created_at', '<=', $endDate)
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date');
            
        $salesData = $salesQuery->get()->pluck('total', 'date')->toArray();
        $ordersData = $ordersQuery->get()->pluck('count', 'date')->toArray();
        
        // Fill in missing dates
        $current = clone $startDate;
        $this->salesData = [];
        $this->ordersData = [];
        
        while ($current <= $endDate) {
            $date = $current->format('Y-m-d');
            $this->salesData[$date] = $salesData[$date] ?? 0;
            $this->ordersData[$date] = $ordersData[$date] ?? 0;
            $current->addDay();
        }
    }
    
    public function updatePeriod($period)
    {
        $this->period = $period;
        $this->loadStats();
    }
    
    public function render()
    {
        // Get recent orders
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
            
        // Get top-selling products
        $topProducts = DB::table('order_items')
            ->select('product_id', 'product_name', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();
            
        return view('livewire.admin.dashboard.admin-dashboard', [
            'recentOrders' => $recentOrders,
            'topProducts' => $topProducts
        ]);
    }
}

