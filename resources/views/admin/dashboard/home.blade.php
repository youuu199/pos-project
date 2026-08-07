@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                ကုန်ပစ္စည်းများ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                အော်ဒါများ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                သုံးစွဲသူများ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                ဝင်ငွေ</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalRevenue) }} MMK</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Recent Orders -->
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">နောက်ဆုံးအော်ဒါများ</h6>
                    <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-primary">အားလုံးကြည့်ရန်</a>
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>အော်ဒါကုဒ်</th>
                                        <th>သုံးစွဲသူ</th>
                                        <th>ကုန်ပစ္စည်း</th>
                                        <th>ပမာဏ</th>
                                        <th>စုစုပေါင်း</th>
                                        <th>အခြေအနေ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td><a href="{{ route('admin.orders.view', $order->id) }}">{{ $order->order_code }}</a></td>
                                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                                            <td>{{ $order->count }}</td>
                                            <td>{{ number_format($order->total_price) }} MMK</td>
                                            <td>
                                                @if($order->status === 'preparing')
                                                    <span class="badge badge-warning">ပြင်ဆင်နေသည်</span>
                                                @elseif($order->status === 'completed')
                                                    <span class="badge badge-success">ပြီးဆုံးသည်</span>
                                                @else
                                                    <span class="badge badge-danger">ပယ်ဖျက်သည်</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-gray-500">အော်ဒါများ မရှိသေးပါ။</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Low Stock Products -->
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">လက်ကျန်နည်းကုန်ပစ္စည်းများ</h6>
                </div>
                <div class="card-body">
                    @if($lowStockProducts->count() > 0)
                        @foreach($lowStockProducts as $product)
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <div class="font-weight-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ $product->category->name ?? 'N/A' }}</small>
                                </div>
                                <div>
                                    @if($product->stock == 0)
                                        <span class="badge badge-danger">ကုန်သွားပြီ</span>
                                    @else
                                        <span class="badge badge-warning">{{ $product->stock }} ကျန်</span>
                                    @endif
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p class="text-center text-gray-500">လက်ကျန်နည်းကုန်ပစ္စည်း မရှိပါ။</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">လစဉ်အော်ဒါများ</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="monthlyOrdersChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var ctx = document.getElementById("monthlyOrdersChart");
        if (ctx) {
            var monthlyData = @json($monthlyOrders);
            var labels = monthlyData.map(function(item) {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return months[item.month - 1] + ' ' + item.year;
            });
            var data = monthlyData.map(function(item) {
                return item.count;
            });

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'အော်ဒါအရေအတွက်',
                        data: data,
                        backgroundColor: 'rgba(78, 115, 229, 0.8)',
                        borderColor: 'rgba(78, 115, 229, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    </script>
@endsection
