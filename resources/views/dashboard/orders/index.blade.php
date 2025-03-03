@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
    <h1>Orders</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Summary</th>
                    <th>Proof</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
						<td>
							{{ $order->user->name }}<br>
							Email: {{ $order->user->email }}<br>
							Contact: {{ $order->user->contact }}
						</td>
                        <td>
							<strong>Order ID: {{ $order->id }}</strong>
							<br>
							Products:
                            <ul>
                                @foreach($order->products() as $product)
                                    <li>{{ $product->title }} (Quantity: {{ $product->quantity }})</li>
                                @endforeach
                            </ul>
                            Status: <strong>{{ $order->status }}</strong>
                            <br>
                            Total: <strong>{{ number_format($order->total, 2) }}</strong>
                        </td>
                        <td>
							@if($order->payment_option == 'wallet')
								Wallet ID: {{ $order->user->wallet->id }}<br>
							@else
								<div class="zoom-container">
									<img src="{{ $order->proofUrl() }}" alt="Proof" class="img-thumbnail img-fluid" style="width: 100px; height: 100px;">
								</div>
							@endif
						</td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm mb-1 w-100">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
