@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <x-form 
        :formId="'editOrderForm'"
        :formAction="route('orders.update', $order->id)"
        :method="'PUT'"
        :title="'Edit Order #'.$order->id.' - '.$order->user->name"
        :discardRoute="route('orders.index')"
    >
        <!-- Group 1: Total, Proof & Status -->
        <div class="row mb-3 p-3 bg-light rounded border">
			@if($order->payment_option === 'wallet')
				<div class="col-md-4">
					<label class="form-label">Wallet ID</label>
					<p class="fs-4 fw-bold mb-0">{{ $order->user->wallet->id }}</p>
				</div>
			@else
				<div class="col-md-4">
					<label for="proof" class="form-label">Proof</label>
					<div class="zoom-container">
						<img src="{{ $order->proofUrl() }}" alt="Proof" class="img-thumbnail img-fluid" style="width: 100px; height: 100px;">
					</div>
				</div>
			@endif
			
            <div class="col-md-4">
                <label class="form-label">Total</label>
                <p class="fs-4 fw-bold mb-0">${{ number_format($order->total, 2) }}</p>
            </div>

            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
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
        <!-- Group 3: Delivery Method & Payment Option -->
        <div class="row mb-3 p-3 bg-white rounded border">
            <div class="col-md-6">
                <label class="form-label">Delivery Method</label>
                <p class="form-control-plaintext">{{ $order->delivery_method }}</p>
            </div>
            <div class="col-md-6">
                <label class="form-label">Payment Option</label>
                <p class="form-control-plaintext">{{ $order->payment_option }}</p>
            </div>
        </div>
        <!-- New Group: User Contact with Copy to Clipboard for both Phone & Email -->
        <div class="row mb-3 p-3 bg-light rounded border">
            <div class="col-12">
                <label class="form-label">User Contact</label>
                <p class="form-control-plaintext">
                    Phone: <span id="phoneText">{{ $order->user->contact }}</span>
                    <button type="button" id="copyPhoneBtn" class="btn btn-link p-0">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span id="copyPhoneMessage" style="display:none;">Copied!</span>
                    <br>
                    Email: <span id="emailText">{{ $order->user->email }}</span>
                    <button type="button" id="copyEmailBtn" class="btn btn-link p-0">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <span id="copyEmailMessage" style="display:none;">Copied!</span>
                </p>
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
</script>
@endsection
