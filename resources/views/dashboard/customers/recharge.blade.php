@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 font-weight-bold mb-0">Wallet Recharge</h1>
        <a href="{{ route('myProfile') }}" class="btn btn-outline-secondary btn-sm rounded-pill shadow-sm">
            <i class="fas fa-arrow-left fa-sm mr-1"></i> Back to Profile
        </a>
    </div>

    <x-alert />

    <!-- Wallet Card -->
    <div class="card border-0 shadow-sm mb-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="row g-0">
                <div class="col-md-4 bg-gradient-primary text-white p-4 d-flex flex-column justify-content-center">
                    <h5 class="text-uppercase mb-3 opacity-8">Current Balance</h5>
                    <h2 class="display-5 mb-0">
                        @if(auth()->user()->wallet)
                            ${{ number_format(auth()->user()->wallet->balance, 2) }}
                        @else
                            $0.00
                        @endif
                    </h2>
                </div>
                <div class="col-md-8 p-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-light p-3 mr-4">
                            <i class="fas fa-wallet fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Add funds to your wallet</h5>
                            <p class="text-muted mb-0">Choose a payment method and follow the instructions to recharge your account</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recharge form - improved validation -->
    <form action="{{ route('recharge') }}" method="POST" enctype="multipart/form-data" id="rechargeForm">
        @csrf
        <!-- Remove the wallet_id hidden input field as it's no longer needed -->
        
        <input type="hidden" name="payment_method_id" id="selected_payment_method">
        @error('payment_method_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <!-- Check for pending transaction warning from session -->
        @if(session('error'))
            <div class="alert alert-danger mb-4">{{ session('error') }}</div>
        @endif
        
        <!-- Main Recharge Interface -->
        <div class="row">
            <!-- Payment Method Selection -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary">Payment Methods</h5>
                    </div>
                    <div class="card-body">
                        <div class="payment-methods-list">
                            @foreach($paymentMethods as $method)
                                <div class="payment-method-item mb-3 cursor-pointer" 
                                     data-method-id="{{ $method->id }}">
                                    <div class="payment-method-card p-3 rounded {{ $loop->first ? 'active' : '' }}">
                                        <div class="d-flex align-items-center">
                                            @if($method->image)
                                                <img src="{{ $method->image_path }}" alt="{{ $method->name }}" 
                                                    class="payment-icon mr-3" style="height: 32px; width: 32px; object-fit: contain;">
                                            @else
                                                <div class="payment-icon-placeholder rounded bg-light p-2 mr-3">
                                                    <i class="fas fa-credit-card text-primary"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h6 class="mb-0">{{ $method->name }}</h6>
                                                <small class="text-muted">{{ $method->description ?? 'Instant payment' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Amount Input and Payment Details -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary">Amount & Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <!-- Amount Input Section - Always visible -->
                        <div class="amount-section mb-4 pb-4 border-bottom">
                            <h6 class="text-uppercase text-muted small mb-3">Enter Amount</h6>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-0">$</span>
                                    <input type="number" name="amount" id="amount" 
                                        class="form-control form-control-lg border-0 bg-light @error('amount') is-invalid @enderror" 
                                        value="{{ old('amount') }}" placeholder="0.00" step="0.01" min="1" required>
                                </div>
                                @error('amount')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="calculated-amount mt-3">
                                <div class="p-3 bg-light rounded">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Amount to Pay</span>
                                        <span id="calculatedAmount" class="font-weight-bold">--</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Details Section - Shows after amount is entered -->
                        <div class="payment-details-container" id="paymentDetailsContainer">
                            <h6 class="text-uppercase text-muted small mb-3 payment-details-title">Payment Details</h6>
                            
                            <!-- Extremely simple QR code display -->
                            <div class="qr-display-container text-center mb-4">
                                <div class="bg-white rounded shadow-sm p-3 d-inline-block">
                                    <!-- Simple QR display - nothing fancy -->
                                    <div id="qr_container" style="width: 180px; height: 180px;" class="d-flex align-items-center justify-content-center">
                                        <i class="fas fa-qrcode text-muted" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Address Copy -->
                            <div class="payment-address mb-4">
                                <label class="form-label text-muted small">Payment Address</label>
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light" id="wallet_address" readonly>
                                    <button class="btn btn-outline-primary" type="button" id="copy_address">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                                <div class="copy-feedback mt-1 text-success" style="display: none;">
                                    <small><i class="fas fa-check"></i> Copied to clipboard</small>
                                </div>
                            </div>
                            
                            <!-- Currency Rate -->
                            <div class="card bg-light border-0 mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <span class="text-muted">Exchange Rate</span>
                                        <span id="payment_rate" class="font-weight-bold">1 USD = 1.00</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Instructions -->
                            <div class="payment-instructions">
                                <h6 class="text-uppercase text-muted small mb-2">Instructions</h6>
                                <p id="payment_instructions" class="text-muted small">Please scan the QR code with your payment app or copy the address to make a payment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Screenshot Upload - add maxlength info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 text-primary">Payment Confirmation</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-4">
                            <label for="screenshot" class="form-label d-block mb-3">
                                Upload Payment Screenshot
                                <small class="text-muted d-block">Maximum file size: 2MB</small>
                            </label>
                            
                            <!-- Upload area - will be hidden when preview is showing -->
                            <div class="custom-file-upload border rounded p-4 text-center">
                                <div class="upload-placeholder mb-0">
                                    <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                                    <p class="mb-2" id="file-name-display">Click or drop file here</p>
                                    <small class="text-muted d-block mb-3">Supported formats: JPG, PNG, GIF</small>
                                    <label for="screenshot" class="btn btn-sm btn-outline-primary mb-0">Select File</label>
                                    <input type="file" name="screenshot" id="screenshot" 
                                        class="file-input-hidden position-absolute" accept="image/*" 
                                        style="opacity: 0; width: 1px; height: 1px;" required>
                                </div>
                            </div>
                            
                            <!-- Preview container - shown only when image is uploaded -->
                            <div class="preview-container mt-3" style="display: none;">
                                <div class="position-relative border rounded p-2">
                                    <button type="button" class="btn btn-sm btn-light position-absolute top-0 end-0 m-1 remove-preview">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <img id="screenshotPreview" src="" alt="Screenshot Preview" class="img-fluid rounded" style="max-height: 200px; width: 100%; object-fit: contain;">
                                </div>
                            </div>
                            
                            @error('screenshot')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" id="confirm_payment" name="confirm_payment" required>
                            <label class="form-check-label" for="confirm_payment">
                                I confirm that I have made the payment
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            Submit Recharge Request
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
// Payment methods data
const paymentData = @json($paymentMethods);
let selectedMethod = paymentData[0]; // Default to first payment method

document.addEventListener('DOMContentLoaded', function() {
    // Initialize with the first payment method
    updatePaymentDetails(selectedMethod);
    
    // Payment method selection - FIXED: Removed references to non-existent elements
    const methodItems = document.querySelectorAll('.payment-method-item');
    methodItems.forEach(item => {
        item.addEventListener('click', function() {
            // Update active state
            document.querySelectorAll('.payment-method-card').forEach(card => {
                card.classList.remove('active');
            });
            this.querySelector('.payment-method-card').classList.add('active');
            
            // Get selected method data
            const methodId = this.dataset.methodId;
            selectedMethod = paymentData.find(m => m.id == methodId);
            
            // Update UI with animation
            setTimeout(() => {
                updatePaymentDetails(selectedMethod);
            }, 300);
        });
    });
    
    // Set the first payment method as default
    document.getElementById('selected_payment_method').value = selectedMethod.id;
    
    // Screenshot preview - fixed to prevent interfering with other fields
    const screenshotInput = document.getElementById('screenshot');
    if (screenshotInput) {
        screenshotInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                // Check file size (max 2MB = 2 * 1024 * 1024)
                if (file.size > 2 * 1024 * 1024) {
                    alert('File is too large! Maximum size is 2MB.');
                    this.value = '';
                    return;
                }
                
                // Update file label
                const fileNameDisplay = document.getElementById('file-name-display');
                if (fileNameDisplay) fileNameDisplay.textContent = file.name;
                
                // Preview image
                const reader = new FileReader();
                reader.onload = function(event) {
                    // Set preview image source
                    const preview = document.getElementById('screenshotPreview');
                    if (preview) preview.setAttribute('src', event.target.result);
                    
                    // Hide upload area, show preview
                    const fileUploadArea = document.querySelector('.custom-file-upload');
                    const previewContainer = document.querySelector('.preview-container');
                    
                    if (fileUploadArea) fileUploadArea.style.display = 'none';
                    if (previewContainer) previewContainer.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Remove preview button fixed to toggle between preview and upload area
    const removePreviewButton = document.querySelector('.remove-preview');
    if (removePreviewButton) {
        removePreviewButton.addEventListener('click', function() {
            // Get references to elements
            const fileUploadArea = document.querySelector('.custom-file-upload');
            const previewContainer = document.querySelector('.preview-container');
            const screenshot = document.getElementById('screenshot');
            const fileNameDisplay = document.getElementById('file-name-display');
            
            // Hide preview, show upload area
            if (previewContainer) previewContainer.style.display = 'none';
            if (fileUploadArea) fileUploadArea.style.display = 'block';
            
            // Reset input and label
            if (screenshot) screenshot.value = '';
            if (fileNameDisplay) fileNameDisplay.textContent = 'Click or drop file here';
        });
    }
    
    // Amount input handler - calculate payment amount
    const amountInput = document.getElementById('amount');
    if (amountInput) {
        amountInput.addEventListener('input', calculatePayable);
        // Focus on amount input when page loads
        amountInput.focus();
    }
    
    // Copy address button
    const copyButton = document.getElementById('copy_address');
    if (copyButton) {
        copyButton.addEventListener('click', function() {
            const addressField = document.getElementById('wallet_address');
            addressField.select();
            document.execCommand('copy');
            
            // Show copied feedback
            const feedback = document.querySelector('.copy-feedback');
            feedback.style.display = 'block';
            feedback.classList.add('visible');
            
            setTimeout(() => {
                feedback.classList.remove('visible');
                setTimeout(() => {
                    feedback.style.display = 'none';
                }, 300);
            }, 1500);
        });
    }
    
    // Form submission validation - modified to remove wallet check
    const rechargeForm = document.getElementById('rechargeForm');
    if (rechargeForm) {
        rechargeForm.addEventListener('submit', function(e) {
            const methodId = document.getElementById('selected_payment_method').value;
            
            if (!methodId) {
                e.preventDefault();
                alert('Please select a payment method.');
                return;
            }
            
            // Remove wallet ID check since we're creating wallets on demand in the controller
        });
    }
});

function updatePaymentDetails(method) {
    // Update selected payment method ID in form
    document.getElementById('selected_payment_method').value = method.id;
    
    // Update title with animate
    const titleElem = document.querySelector('.payment-details-title');
    if (titleElem) {
        titleElem.style.opacity = 0;
        setTimeout(() => {
            titleElem.textContent = method.name + ' Payment Details';
            titleElem.style.opacity = 1;
        }, 200);
    }
    
    // Ultra simple QR approach - just replace the entire container's contents
    const qrContainer = document.getElementById('qr_container');
    
    // Clear whatever was in there before
    qrContainer.innerHTML = '';
    
    if (method.qr_path) {
        // Just create and append a new image - no onload/onerror complexity
        const qrImg = document.createElement('img');
        qrImg.src = method.qr_path;
        qrImg.alt = "Payment QR";
        qrImg.style.width = "180px";
        qrImg.style.height = "180px";
        qrContainer.appendChild(qrImg);
    } else {
        // If no QR, just show an icon
        qrContainer.innerHTML = '<i class="fas fa-qrcode text-muted" style="font-size: 3rem;"></i>';
    }
    
    // Update address field - simplified without animations
    const addressElem = document.getElementById('wallet_address');
    if (addressElem) {
        addressElem.value = method.address || '';
    }
    
    // Update instructions - simplified
    const instructionsElem = document.getElementById('payment_instructions');
    if (instructionsElem) {
        instructionsElem.textContent = method.instruction || 'Please scan the QR code or send payment to the address above.';
    }
    
    // Update rate - simplified
    const rateElem = document.getElementById('payment_rate');
    if (rateElem) {
        rateElem.textContent = method.rate ? '1 USD = ' + method.rate + ' ' + method.name : 'N/A';
    }
    
    // Calculate initial payable amount
    calculatePayable();
}

function calculatePayable() {
    const amount = parseFloat(document.getElementById('amount').value);
    const calcDiv = document.getElementById('calculatedAmount');
    
    if (amount && selectedMethod && selectedMethod.rate) {
        let payable = amount * parseFloat(selectedMethod.rate);
        calcDiv.textContent = selectedMethod.name + ' ' + payable.toFixed(2);
    } else {
        calcDiv.textContent = '--';
    }
}
</script>
@endpush

@endsection
