@extends('dashboard.layouts.app')
@section('content')
<div class="container py-5">
	<x-alert />
    <div class="row">
        <!-- Profile Sidebar -->
        <div class="col-lg-3">
			<div class="card shadow-sm">
				<div class="card-body text-center">
					<!-- New Wallet Balance Block with Bootstrap icon -->
					<div class="card mb-3 shadow-sm">
						<div class="card-body d-flex justify-content-between align-items-center">
							<div class="d-flex align-items-center">
								<i class="bi bi-wallet2 text-primary"></i>
								<strong class="ms-3">${{ number_format($customer->wallet->balance, 2) }}</strong>
							</div>
							<!-- Changed recharge button to trigger modal -->
							<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#rechargeModal">
								Recharge
							</button>
						</div>
					</div>
					<!-- Profile Initial Avatar -->
					<div class="profile-icon bg-primary rounded-circle mb-3 text-white d-flex align-items-center justify-content-center mx-auto" style="width: 80px; height: 80px; font-size: 36px;">
						{{ strtoupper(substr($customer->name, 0, 1)) }}
					</div>
					<!-- Customer Name and Email -->
					<h5 class="mb-1">{{ $customer->name }}</h5>
					<p class="text-muted mb-3">{{ $customer->email }}</p>
					<hr>
					<div class="d-flex justify-content-between mb-2">
						<span><i class="bi bi-cart"></i> Total Orders</span>
						<span class="font-weight-bold">{{ count($customer->orders) }}</span>
					</div>
					<div class="d-flex justify-content-between mb-2">
						<span><i class="bi bi-calendar"></i> Joined On</span>
						<span class="font-weight-bold">{{ $customer->created_at->format('M d, Y') }}</span>
					</div>
				</div>
			</div>
        </div>

        <!-- Profile Content -->
        <div class="col-lg-9">
            <!-- Removed tab functionality and orders section; Only profile update is kept -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
                <div class="card-body">
                    <!-- Updated form tag without image upload field -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Full Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $customer->name }}">
								@error('name')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="col-md-6">
								<label class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $customer->email }}">
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-md-6">
								<label class="form-label">Telegram/WhatsApp</label>
								<input type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $customer->contact }}">
								@error('contact')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                </div>
            </div>
            
            <!-- Recharge History -->
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Recharge History</h5>
                </div>
                <div class="card-body">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Payment Method</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->created_at->format('d M Y, h:i A') }}</td>
                                        <td>{{ number_format($transaction->amount, 2) }}</td>
                                        <td>{{ $transaction->paymentMethod->name }}</td>
                                        <td class="text-center">
                                            <span class="badge bg-{{ $transaction->status == 'approved' ? 'success' : ($transaction->status == 'pending' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $transactions->links() }}
                        </div>
                    @else
                        <div class="text-center py-3">
                            <i class="bi bi-wallet2 text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">No recharge history found.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recharge Modal -->
<div class="modal fade" id="rechargeModal" tabindex="-1" aria-labelledby="rechargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('recharge') }}" method="POST" enctype="multipart/form-data" id="rechargeForm">
				@csrf
				<input type="hidden" name="wallet_id" value="{{ $customer->wallet->id }}">
				<div class="modal-header">
					<h5 class="modal-title" id="rechargeModalLabel">Recharge Wallet</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
                    @error('pending', 'recharge')
                        <div class="alert alert-warning">
                            {{ $message }}
                        </div>
                    @else
                        @if($errors->recharge->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->recharge->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!-- Rest of the form fields -->
                        <div class="mb-3">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select name="payment_method_id" id="payment_method" class="form-select @error('payment_method_id', 'recharge') is-invalid @enderror">
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method->id }}" {{ old('payment_method_id') == $method->id ? 'selected' : '' }}>
                                        {{ $method->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_method_id', 'recharge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="paymentInfo" class="mt-2"></div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Recharge Amount</label>
                            <input type="number" name="amount" id="amount" class="form-control @error('amount', 'recharge') is-invalid @enderror" 
                                value="{{ old('amount') }}" placeholder="Enter amount">
                            @error('amount', 'recharge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="calculatedAmount" class="mt-2"></div>
                        </div>
                        <!-- New image upload field for modal with preview -->
                        <div class="mb-3">
                            <label for="screenshot" class="form-label">Upload screenshot</label>
                            <input type="file" name="screenshot" id="screenshot" 
                                class="form-control @error('screenshot', 'recharge') is-invalid @enderror" accept="image/*">
                            @error('screenshot', 'recharge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="screenshotPreview" src="" alt="Screenshot Preview" style="max-width: 150px; margin-top: 10px; display: none;">
                        </div>
                    @enderror
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Updated JavaScript for screenshot preview, payment method info, and calculated payable amount -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Screenshot preview
    const screenshotInput = document.getElementById('screenshot');
    if (screenshotInput) {
        screenshotInput.addEventListener('change', function(){
            const file = this.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const preview = document.getElementById('screenshotPreview');
                    preview.setAttribute('src', event.target.result);
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Payment method change handler
    const paymentMethodSelect = document.getElementById('payment_method');
    if (paymentMethodSelect) {
        paymentMethodSelect.addEventListener('change', function(){
            const selectedId = this.value;
            const infoDiv = document.getElementById('paymentInfo');
            const method = paymentData.find(m => m.id == selectedId);
            if(method) {
                infoDiv.innerHTML = "<strong>Address:</strong> " + method.address +
                    " <button type='button' class='btn btn-sm btn-outline-secondary' onclick='copyAddress(this, \"" + method.address + "\")'>Copy</button>" +
                    "<br><strong>Instruction:</strong> " + method.instruction;
            } else {
                infoDiv.innerHTML = "";
            }
            calculatePayable();
        });

        // Trigger initial change event
        paymentMethodSelect.dispatchEvent(new Event('change'));
    }

    // Amount input handler
    const amountInput = document.getElementById('amount');
    if (amountInput) {
        amountInput.addEventListener('input', calculatePayable);
    }

    // Form submission handler
    const rechargeForm = document.getElementById('rechargeForm');
    if (rechargeForm) {
        rechargeForm.addEventListener('submit', function(e) {
            console.log('Form submitting...');
            console.log('Wallet ID:', this.querySelector('[name="wallet_id"]').value);
            console.log('Payment Method:', this.querySelector('[name="payment_method_id"]').value);
            console.log('Amount:', this.querySelector('[name="amount"]').value);
            console.log('Screenshot:', this.querySelector('[name="screenshot"]').files[0]);
        });
    }

    // Modal auto-opening on validation errors
    @if($errors->recharge->any())
        var rechargeModal = new bootstrap.Modal(document.getElementById('rechargeModal'));
        rechargeModal.show();
    @endif
});

// Keep these functions outside since they're called from HTML
function copyAddress(button, text) {
    navigator.clipboard.writeText(text).then(() => {
        const originalText = button.innerHTML;
        button.innerHTML = "Copied!";
        setTimeout(function() {
            button.innerHTML = originalText;
        }, 2000);
    });
}

function calculatePayable() {
    const amount = parseFloat(document.getElementById('amount').value);
    const selectedId = document.getElementById('payment_method').value;
    const method = paymentData.find(m => m.id == selectedId);
    const calcDiv = document.getElementById('calculatedAmount');
    if(amount && method && method.rate) {
        let payable = amount * parseFloat(method.rate);
        calcDiv.innerHTML = "<strong>Payable Amount:</strong> $" + payable.toFixed(2);
    } else {
        calcDiv.innerHTML = "";
    }
}

// Pass payment methods data to JavaScript
var paymentData = @json($paymentMethods);
</script>
@endsection