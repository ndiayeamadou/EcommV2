<div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-2xl font-bold mb-6">Dashboard</h1>
            
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Revenue -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-primary-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Total Sales ({{ $period }})
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                                            ${{ number_format($totalSales, 2) }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                        <div class="text-sm">
                            <div class="flex space-x-2">
                                <button wire:click="updatePeriod('today')" class="text-primary-600 hover:text-primary-900 {{ $period === 'today' ? 'font-bold' : '' }}">
                                    Today
                                </button>
                                <button wire:click="updatePeriod('week')" class="text-primary-600 hover:text-primary-900 {{ $period === 'week' ? 'font-bold' : '' }}">
                                    Week
                                </button>
                                <button wire:click="updatePeriod('month')" class="text-primary-600 hover:text-primary-900 {{ $period === 'month' ? 'font-bold' : '' }}">
                                    Month
                                </button>
                                <button wire:click="updatePeriod('year')" class="text-primary-600 hover:text-primary-900 {{ $period === 'year' ? 'font-bold' : '' }}">
                                    Year
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Orders -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Total Orders
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $totalOrders }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                        <a href="{{ route('admin.orders') }}" class="text-sm text-primary-600 hover:text-primary-900">
                            View all orders
                        </a>
                    </div>
                </div>
                
                <!-- Customers -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Total Customers
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $totalCustomers }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                        <a href="{{ route('admin.users') }}" class="text-sm text-primary-600 hover:text-primary-900">
                            View all customers
                        </a>
                    </div>
                </div>
                
                <!-- Low Stock Products -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                        Low Stock Products
                                    </dt>
                                    <dd>
                                        <div class="text-lg font-medium text-gray-900 dark:text-white">
                                            {{ $lowStockProducts }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-5 py-3">
                        <a href="{{ route('admin.products') }}?stock=low" class="text-sm text-primary-600 hover:text-primary-900">
                            View low stock products
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium mb-4">Weekly Sales</h3>
                    <div class="h-64" id="sales-chart"></div>
                </div>
                
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-medium mb-4">Weekly Orders</h3>
                    <div class="h-64" id="orders-chart"></div>
                </div>
            </div>
            
            <!-- Recent Orders & Top Products -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Orders -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium">Recent Orders</h3>
                    </div>
                    <div class="px-6 py-4">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($recentOrders as $order)
                                <li class="py-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $order->order_number }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $order->user ? $order->user->name : $order->first_name . ' ' . $order->last_name }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $order->created_at->format('M d, Y H:i') }}
                                            </p>
                                        </div>
                                        <div>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">${{ number_format($order->total, 2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-gray-500 dark:text-gray-400">No recent orders</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3">
                        <a href="{{ route('admin.orders') }}" class="text-sm text-primary-600 hover:text-primary-900">
                            View all orders
                        </a>
                    </div>
                </div>
                
                <!-- Top Products -->
                <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="text-lg font-medium">Top Selling Products</h3>
                    </div>
                    <div class="px-6 py-4">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                            
                            <li class="py-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            Test
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">
                                            9.000 units sold
                                        </p>
                                    </div>
                                </div>
                            </li>
                            {{-- @forelse($topProducts as $product)
                                <li class="py-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $product->product_name }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                {{ $product->total_sold }} units sold
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="py-4 text-center text-gray-500 dark:text-gray-400">No product data available</li>
                            @endforelse --}}
                        </ul>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-6 py-3">
                        <a href="{{ route('admin.products') }}" class="text-sm text-primary-600 hover:text-primary-900">
                            View all products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:load', function () {
            var salesData = @json($salesData);
            var ordersData = @json($ordersData);
            
            var dates = Object.keys(salesData);
            var salesValues = Object.values(salesData);
            var ordersValues = Object.values(ordersData);
            
            // Sales Chart
            var salesChart = new ApexCharts(document.getElementById('sales-chart'), {
                chart: {
                    type: 'area',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Sales',
                    data: salesValues
                }],
                xaxis: {
                    categories: dates.map(date => {
                        return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    }),
                    labels: {
                        style: {
                            colors: '#9e9e9e'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return '$' + value.toFixed(2);
                        },
                        style: {
                            colors: '#9e9e9e'
                        }
                    }
                },
                colors: ['#8b5cf6'],
                stroke: {
                    curve: 'smooth',
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        type: 'vertical',
                        shadeIntensity: 0.4,
                        inverseColors: false,
                        opacityFrom: 0.8,
                        opacityTo: 0.2,
                        stops: [0, 100]
                    }
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return '$' + value.toFixed(2);
                        }
                    }
                }
            });
            salesChart.render();
            
            // Orders Chart
            var ordersChart = new ApexCharts(document.getElementById('orders-chart'), {
                chart: {
                    type: 'bar',
                    height: '100%',
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Orders',
                    data: ordersValues
                }],
                xaxis: {
                    categories: dates.map(date => {
                        return new Date(date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
                    }),
                    labels: {
                        style: {
                            colors: '#9e9e9e'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                            return Math.round(value);
                        },
                        style: {
                            colors: '#9e9e9e'
                        }
                    }
                },
                colors: ['#3b82f6'],
                plotOptions: {
                    bar: {
                        borderRadius: 5,
                        columnWidth: '50%',
                    },
                },
                dataLabels: {
                    enabled: false
                },
                tooltip: {
                    y: {
                        formatter: function(value) {
                            return Math.round(value) + ' orders';
                        }
                    }
                }
            });
            ordersChart.render();
            
            Livewire.on('updateCharts', () => {
                salesChart.updateSeries([{
                    data: Object.values(@this.salesData)
                }]);
                
                ordersChart.updateSeries([{
                    data: Object.values(@this.ordersData)
                }]);
            });
        });
    </script>
    @endpush
</div>
