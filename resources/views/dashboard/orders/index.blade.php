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
							<strong>Order ID: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
							<br>
							Products:
                            <ul>
                                @foreach($order->products() as $product)
                                    <li>{{ $product->title }} (Quantity: {{ $product->quantity }})</li>
                                @endforeach
                            </ul>
                            Status: <strong>{{ $order->status }}</strong>
                            <br>
                            Total: <strong>${{ number_format($order->total, 2) }}</strong>
                        </td>
                        <td>
							@if($order->payment_option == 'Wallet')
								<label class="form-label">Paid by Wallet No: {{ $order->user->wallet->id }}</label>
							@else
								<div class="magnify-container">
									<div class="clickable-image-container">
										<img src="{{ $order->proofUrl() }}" alt="Proof" class="img-thumbnail img-fluid proof-thumbnail" data-proof="{{ $order->proofUrl() }}">
										<div class="zoom-icon">
											<i class="fa fa-search-plus"></i>
										</div>
									</div>
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

<!-- Proof Modal -->
<div class="modal fade" id="proofModal" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="proofModalLabel">Payment Proof</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img id="fullProof" src="" alt="Full Proof" style="max-width: 100%;">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
	$(document).ready(function() {
		// Make the entire container clickable
		$('.clickable-image-container').click(function() {
			var proofSrc = $(this).find('.proof-thumbnail').data('proof');
			$('#fullProof').attr('src', proofSrc);
			$('#proofModal').modal('show');
		});
	});
</script>
@endpush
