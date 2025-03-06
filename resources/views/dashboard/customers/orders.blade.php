@extends('dashboard.layouts.app')
@section('title', 'My Orders')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Orders</h1>
</div>

<div class="card">
    <div class="card-body">
        @if($orders->count() > 0)
            <!-- Desktop View (md and up) -->
            <div class="d-none d-md-block">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th class="text-right">Total</th>
                                <th class="text-center">Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $order->created_at->format('d M Y') }}</td>
                                <td class="text-right">${{ number_format($order->total, 2) }}</td>
								<td class="text-center">
									<span class="badge bg-{{ $order->status == 'pending' ? 'warning text-dark' : ($order->status == 'completed' ? 'success text-white' : ($order->status == 'processing' ? 'info text-white' : 'danger text-white')) }}">
										{{ ucfirst($order->status) }}
									</span>
								</td>
                                <td class="text-right">
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                        <i class="bi bi-eye"></i> Details
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile View (sm and down) -->
            <div class="d-md-none">
                @foreach($orders as $order)
                    <div class="mobile-card mb-3">
                        <div class="card-body p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <div class="mobile-card-title">Order ID</div>
                                    <div class="mobile-card-value">#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </div>
                                <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'danger') }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </div>
                            
                            <div class="row mobile-order-row">
                                <div class="col-6">
                                    <div class="mobile-card-title">Date</div>
                                    <div class="mobile-card-value">{{ $order->created_at->format('d M Y') }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="mobile-card-title">Total</div>
                                    <div class="mobile-card-value">${{ number_format($order->total, 2) }}</div>
                                </div>
                            </div>
                            
                            <div class="text-right mt-2">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                    <i class="bi bi-eye"></i> Details
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $orders->links() }}
            </div>
            
            <!-- Order Modals -->
            @foreach($orders as $order)
            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Order #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- Order Summary -->
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Order Summary</h6>
                                            <dl class="row mb-0">
                                                <dt class="col-sm-5">Date:</dt>
                                                <dd class="col-sm-7">{{ $order->created_at->format('d M Y, h:i A') }}</dd>

                                                <dt class="col-sm-5">Status:</dt>
                                                <dd class="col-sm-7">
                                                    <span class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'completed' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($order->status) }}
                                                    </span>
                                                </dd>

                                                <dt class="col-sm-5">Payment:</dt>
                                                <dd class="col-sm-7">{{ ucfirst($order->payment_option) }}</dd>

                                                <dt class="col-sm-5">Delivery:</dt>
                                                <dd class="col-sm-7">{{ ucfirst($order->delivery_method) }}</dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Notes -->
                                <div class="col-md-6">
                                    <div class="card h-100">
                                        <div class="card-body">
                                            <h6 class="card-title">Order Notes</h6>
                                            <p class="card-text mb-0">{{ $order->order_notes ?: 'No notes provided' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Order Items -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Order Items</h6>
                                            <ul class="list-unstyled mb-0">
                                                @foreach($order->products() as $product)
                                                    <li class="mb-2">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span class="text-truncate-custom mr-2">{{ $product->title }} × {{ $product->quantity }}</span>
                                                            <span>${{ number_format($product->price * $product->quantity, 2) }}</span>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                <li class="border-top pt-2 mt-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <strong>Total Amount:</strong>
                                                        <strong>${{ number_format($order->total, 2) }}</strong>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                @if($order->proof)
                                <!-- Payment Proof -->
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">Payment Proof</h6>
                                            <img src="{{ $order->proofUrl() }}" alt="Payment Proof" class="img-fluid rounded" style="max-height: 200px;">
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="text-center py-4">
                <i class="bi bi-receipt text-muted" style="font-size: 2rem;"></i>
                <p class="text-muted mt-2">You haven't placed any orders yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
