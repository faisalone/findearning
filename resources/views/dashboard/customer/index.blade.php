@extends('dashboard.layouts.app')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Dashboard</h1>
    </div>

    <!-- Welcome Message -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Welcome, {{ $user->name }}!</h6>
        </div>
        <div class="card-body">
            <p>Welcome to your personal dashboard. Here you can view your order history and track recent orders.</p>
            <p>Need assistance? Feel free to <a href="{{ route('contact') }}">contact us</a>.</p>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <!-- Total Orders Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Your Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-bag fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Spent Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalSpent, 2) }}</div>
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

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Your Recent Orders</h6>
                    @if(Route::has('myOrders'))
                        <a href="{{ route('myOrders') }}" class="btn btn-sm btn-primary">View All Orders</a>
                    @endif
                </div>
                <div class="card-body">
                    @if($recentOrders->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr>
                                            <td>#{{ $order->id }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>${{ number_format($order->total, 2) }}</td>
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
                    @else
                        <p class="text-center">You haven't placed any orders yet.</p>
                        <div class="text-center">
                            <a href="{{ route('shop') }}" class="btn btn-primary">Start Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Account Actions -->
    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Links</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(Route::has('myProfile'))
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('myProfile') }}" class="btn btn-block btn-primary">
                                <i class="fas fa-user mr-2"></i> My Profile
                            </a>
                        </div>
                        @endif
                        
                        @if(Route::has('myOrders'))
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('myOrders') }}" class="btn btn-block btn-info">
                                <i class="fas fa-shopping-bag mr-2"></i> My Orders
                            </a>
                        </div>
                        @endif
                        
                        <div class="col-md-4 mb-3">
                            <a href="{{ route('shop') }}" class="btn btn-block btn-success">
                                <i class="fas fa-shopping-cart mr-2"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
