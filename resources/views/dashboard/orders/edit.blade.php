@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
    <x-form 
        :formId="'editOrderForm'"
        :formAction="route('orders.update', $order->id)"
        :method="'PUT'"
        :title="'Edit Order #'.str_pad($order->id, 5, '0', STR_PAD_LEFT).' - '.$order->user->name"
        :discardRoute="route('orders.index')"
    >
        <!-- Group 1: Total, Proof & Status -->
        <div class="row mb-3 p-3 bg-light rounded border">
			<div class="col-md-4">
				<label class="form-label">User Contact</label>
				<p class="form-control-plaintext">
					<strong>Name:</strong> {{ $order->customer_name }}<br>
					
					@if($order->customer_email)
						<strong>Email:</strong> <span id="emailText">{{ $order->customer_email }}</span>
						<button type="button" id="copyEmailBtn" class="btn btn-link p-0">
							<i class="fa fa-clipboard"></i>
						</button>
						<span id="copyEmailMessage" style="display:none;">Copied!</span><br>
					@endif

					@if($order->customer_contact)
						<strong>Phone:</strong> <span id="phoneText">{{ $order->customer_contact }}</span>
						<button type="button" id="copyPhoneBtn" class="btn btn-link p-0">
							<i class="fa fa-clipboard"></i>
						</button>
						<span id="copyPhoneMessage" style="display:none;">Copied!</span>
					@endif
				</p>
			</div>
			
            <div class="col-md-4">
                <label class="form-label">Total</label>
                <p class="font-weight-bold mb-0">${{ number_format($order->total, 2) }}</p>
            </div>

			<div class="col-md-4">
				<label for="status" class="form-label">Status</label>
				<select class="form-control" id="status" name="status">
					<option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
					<option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
					<option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
					<option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
				</select>
			</div>
        </div>
		<!-- Group 3: Delivery Method & Payment Option -->
		<div class="row mb-3 p-3 bg-white rounded border">
            <div class="col-md-4">
                <label class="form-label">Delivery Method</label>
                <p class="form-control-plaintext">{{ $order->delivery_method }}</p>
            </div>
            <div class="col-md-4">
                <label class="form-label">Payment Option</label>
                <p class="form-control-plaintext">{{ $order->payment_option }}</p>
            </div>
			<div class="col-md-4">
				<label for="proof" class="form-label">Proof</label>
				<div class="magnify-container">
					<div class="clickable-image-container">
						<img src="{{ $order->proofUrl() }}" alt="Proof" class="img-thumbnail img-fluid proof-thumbnail" style="width: 100px; height: 100px;" data-proof="{{ $order->proofUrl() }}">
						<div class="zoom-icon">
							<i class="fa fa-search-plus"></i>
						</div>
					</div>
				</div>
			</div>
        </div>
        <!-- Group 2: Products -->
        <div class="row mb-3 p-3 bg-white rounded border">
            <div class="col-12">
                <label class="form-label">Products</label>
                <ul class="list-group">
                    @foreach($order->products() as $product)
                        <li class="list-group-item d-flex align-items-center">
                            <img src="{{ $product->imagePaths[0]['url'] }}" alt="" style="max-width: 100px; margin-right: 10px;">
                            <div>
                                <strong>{{ $product->title }}</strong> (Quantity: {{ $product->quantity }})
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- New Group: User Contact with Copy to Clipboard for both Phone & Email -->
        <div class="row mb-3 p-3 bg-light rounded border">
            <div class="col-12">
                
            </div>
        </div>
        <!-- Group 4: Order Notes -->
        <div class="row mb-3 p-3 bg-light rounded border">
            <div class="col-12">
                <label for="order_notes" class="form-label">Order Notes</label>
                <textarea class="form-control" id="order_notes" rows="3" disabled style="background-color: transparent; border: none;">{{ $order->order_notes }}</textarea>
            </div>
        </div>
    </x-form>
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

<script>
document.getElementById("copyPhoneBtn").addEventListener("click", function(){
    var phoneText = document.getElementById("phoneText").innerText;
    navigator.clipboard.writeText(phoneText).then(function() {
        var copyMsg = document.getElementById("copyPhoneMessage");
        copyMsg.style.display = "inline";
        setTimeout(function(){ copyMsg.style.display = "none"; }, 2000);
    });
});

document.getElementById("copyEmailBtn").addEventListener("click", function(){
    var emailText = document.getElementById("emailText").innerText;
    navigator.clipboard.writeText(emailText).then(function() {
        var copyMsg = document.getElementById("copyEmailMessage");
        copyMsg.style.display = "inline";
        setTimeout(function(){ copyMsg.style.display = "none"; }, 2000);
    });
});

// Add proof modal functionality
$(document).ready(function() {
    $('.clickable-image-container').click(function() {
        var proofSrc = $(this).find('.proof-thumbnail').data('proof');
        $('#fullProof').attr('src', proofSrc);
        $('#proofModal').modal('show');
    });
});
</script>
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
