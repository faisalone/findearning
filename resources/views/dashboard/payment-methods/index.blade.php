@extends('dashboard.layouts.app')

@section('content')
<div class="container mt-4">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1>Payment Methods</h1>
		<a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Create New Payment Method</a>
	</div>

	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th>image</th>
					<th>Name(Instruction)</th>
					<th>Address</th>
					<th>Rate</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($paymentMethods as $paymentMethod)
				<tr>
					<td>
						@if($paymentMethod->image)
							<img src="{{ $paymentMethod->image_path }}" alt="{{ $paymentMethod->name }}" class="img-fluid" style="max-width:50px;">
						@endif
					</td>
					<td>{{ $paymentMethod->name }}( {{ $paymentMethod->instruction }})</td>
					<td>{{ $paymentMethod->address }}</td>
					<td>{{ $paymentMethod->rate }}</td>
					<td>{{ $paymentMethod->status ? 'Active' : 'Inactive' }}</td>
					<td>
						<a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" class="btn btn-sm btn-info">Edit</a>
						<form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline;">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="d-flex justify-content-center">
		{{ $paymentMethods->links() ?? '' }}
	</div>
</div>
@endsection