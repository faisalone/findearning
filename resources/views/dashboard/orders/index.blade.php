@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <h1>Orders</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Products</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Proof</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }} ({{ $order->user->email }})</td>
                        <td>
                            <ul>
                                @foreach($order->products() as $product)
                                    <li>{{ $product->title }} (Quantity: {{ $product->quantity }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->status }}</td>
                        <td>
                            <div class="zoom-container">
                                <img src="{{ $order->proofUrl() }}" alt="Proof" class="img-thumbnail img-fluid" style="width: 100px; height: 100px;">
                            </div>
                        </td>
                        <td>
                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('styles')
<style>
    .zoom-container {
        position: relative;
        display: inline-block;
    }

    .zoom-container img {
        transition: transform 0.2s;
    }

    .zoom-container:hover img {
        transform: scale(2);
    }
</style>
@endpush
