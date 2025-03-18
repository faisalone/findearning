@extends('dashboard.layouts.app')
@section('title', 'Orders')
@section('content')
<div class="container-fluid px-0 px-md-2">
	<x-alert />
    <h1>Orders</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Customer Info</th>
                    <th>Order Summary</th>
                    <th>Proof</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
						<td>
							Name: {{ $order->customer_name }}<br>
							@if($order->user)
								Email: {{ $order->user->email ?? 'Not available' }}<br>
								Contact: {{ $order->user->contact ?? 'Not available' }}<br>
							@endif
						</td>
						<td>
							<strong>Order ID: #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
							<br>
							<p class="form-control-plaintext">
								<strong>Delivery Method: {{ $order->delivery_method }}  => </strong>
								@if($order->delivery_method == 'email')
									<span class="emailText">{{ $order->customer_email }}</span>
									<button type="button" class="copyEmailBtn btn btn-link p-0">
										<i class="fa fa-clipboard"></i>
									</button>
									<span class="copyEmailMessage" style="display:none;">Copied!</span>
								@else
									<span class="phoneText">{{ $order->customer_contact }}</span>
									<button type="button" class="copyPhoneBtn btn btn-link p-0">
										<i class="fa fa-clipboard"></i>
									</button>
									<span class="copyPhoneMessage" style="display:none;">Copied!</span>
								@endif
							</p>

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
                            @if($order->status !== 'cancelled')
                                <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning btn-sm mb-1 w-100">Edit</a>
                            @endif
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

        // Event delegation for copy buttons
        $(document).on('click', '.copyPhoneBtn', function() {
            var phoneText = $(this).siblings('.phoneText').text();
            navigator.clipboard.writeText(phoneText).then(function() {
                var copyMsg = $(this).siblings('.copyPhoneMessage');
                copyMsg.show();
                setTimeout(function() { copyMsg.hide(); }, 2000);
            }.bind(this));
        });

        $(document).on('click', '.copyEmailBtn', function() {
            var emailText = $(this).siblings('.emailText').text();
            navigator.clipboard.writeText(emailText).then(function() {
                var copyMsg = $(this).siblings('.copyEmailMessage');
                copyMsg.show();
                setTimeout(function() { copyMsg.hide(); }, 2000);
            }.bind(this));
        });
    });
</script>
@endpush
