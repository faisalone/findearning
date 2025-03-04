@extends('dashboard.layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Total Products Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Products</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Completed Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Recent Orders -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                                        <td>${{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('orders.index') }}" class="btn btn-sm btn-primary">View All Orders</a>
                    </div>
                </div>
            </div>
            
            <!-- Top Categories -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Categories</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Products</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->products_count }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary">View All Categories</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Products Column -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Latest Products</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestProducts as $product)
                                    <tr>
                                        <td><a href="{{ route('products.edit', $product->id) }}">{{ $product->title }}</a></td>
                                        <td>${{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center mt-3">
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">View All Products</a>
                    </div>
                </div>
            </div>

            <!-- Orders Status Summary -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Status Summary</h6>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="small font-weight-bold">Completed Orders 
                            <span class="float-right">
                                {{ $totalOrders > 0 ? round(($completedOrders / $totalOrders) * 100) : 0 }}%
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0 }}%" 
                                aria-valuenow="{{ $totalOrders > 0 ? ($completedOrders / $totalOrders) * 100 : 0 }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="small font-weight-bold">Pending Orders 
                            <span class="float-right">
                                {{ $totalOrders > 0 ? round(($pendingOrders / $totalOrders) * 100) : 0 }}%
                            </span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-warning" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? ($pendingOrders / $totalOrders) * 100 : 0 }}%" 
                                aria-valuenow="{{ $totalOrders > 0 ? ($pendingOrders / $totalOrders) * 100 : 0 }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="small font-weight-bold">Other Orders 
                            <span class="float-right">
                                {{ $totalOrders > 0 ? round((($totalOrders - $completedOrders - $pendingOrders) / $totalOrders) * 100) : 0 }}%
                            </span>
                        </h4>
                        <div class="progress">
                            <div class="progress-bar bg-secondary" role="progressbar" 
                                style="width: {{ $totalOrders > 0 ? (($totalOrders - $completedOrders - $pendingOrders) / $totalOrders) * 100 : 0 }}%" 
                                aria-valuenow="{{ $totalOrders > 0 ? (($totalOrders - $completedOrders - $pendingOrders) / $totalOrders) * 100 : 0 }}" 
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection