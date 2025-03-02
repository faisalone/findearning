@extends('layout.layout')

@php
    $css = '<link rel="stylesheet" href="' . asset('assets/css/variables/variable4.css') . '"/>';
    $title='Checkout';
    $subTitle = 'Shop';
    $subTitle2 = 'Checkout';
@endphp

@section('content')

    <div class="rts-checkout-section">
        <div class="container">
            @if(count($cartItems) > 0)
                <!-- Display stock error message -->
                @error('stock_error')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                
                <!-- Display general error message -->
                @error('error')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                
                <form class="checkout-form" method="POST" action="{{ route('placeOrder') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3 justify-content-between">
                        <label class="delivery-heading mb-3"><h3>Delivery Information:</h3></label>

                        <div class="col-xl-8 col-lg-7">
                            <!-- Shipping Options -->
                            <div class="shipping-options checkout-options mb-3">
                                <span class="shipping">Delivery Method</span>
                                <div class="btn-group d-flex justify-content-center gap-3" role="group">
                                    <input type="radio" class="btn-check delivery-method-radio" name="delivery_method" id="emailDelivery" value="email" required autocomplete="off" {{ old('delivery_method') == 'email' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-secondary rounded-pill" for="emailDelivery">
                                        <img src="{{ asset('assets/images/icons/mail.png') }}" alt="Email" class="delivery-icon"> Email
                                    </label>
                                    <input type="radio" class="btn-check delivery-method-radio" name="delivery_method" id="whatsappDelivery" value="whatsapp" required autocomplete="off" {{ old('delivery_method') == 'whatsapp' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-secondary rounded-pill" for="whatsappDelivery">
                                        <img src="{{ asset('assets/images/icons/whatsapp.png') }}" alt="WhatsApp" class="delivery-icon"> WhatsApp
                                    </label>
                                    <input type="radio" class="btn-check delivery-method-radio" name="delivery_method" id="telegramDelivery" value="telegram" required autocomplete="off" {{ old('delivery_method') == 'telegram' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-secondary rounded-pill" for="telegramDelivery">
                                        <img src="{{ asset('assets/images/icons/telegram.png') }}" alt="Telegram" class="delivery-icon"> Telegram
                                    </label>
                                </div>
                            </div>
                            <!-- Delivery Information Fields -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="input-div">
                                        <input type="text" name="name" placeholder="Name**" required value="{{ old('name') }}">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="input-div">
                                        <input type="text" id="contactInput" name="contact" placeholder="Telegram/WhatsApp**" value="{{ old('contact') }}">
                                        @error('contact')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="input-div">
                                        <input type="email" id="emailInput" name="email" placeholder="Email Address**" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <textarea id="orderNotes" name="order_notes" cols="80" rows="4" placeholder="Order notes (optional)">{{ old('order_notes') }}</textarea>
                                </div>
                            </div>
                            <!-- Payment Options -->
                            <div class="payment-options checkout-options mb-3">
                                <label class="mb-2">Select a payment option:</label>
                                <div class="btn-group d-flex flex-wrap justify-content-center gap-3" role="group">
                                    @foreach($paymentMethods as $method)
                                        <input type="radio" class="btn-check" name="payment_option" id="payment_{{ $method->id }}" value="{{ $method->name }}" required autocomplete="off" {{ old('payment_option') == $method->name ? 'checked' : '' }}>
                                        <label class="btn btn-outline-secondary rounded-pill" for="payment_{{ $method->id }}" onclick="showPaymentInfo('{{ $method->name }}')">
                                            <img src="{{ $method->image_path }}" alt="{{ $method->name }}" class="payment-icon"> {{ $method->name }}
                                        </label>
                                    @endforeach
                                </div>
                                @error('payment_option')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <!-- Payment Details and Upload -->
                            <div id="payment-info-container" class="d-none">
                                <div id="payment-details">
                                    <div class="p-3 mb-3">
                                        <h5>Step 1: Payment</h5>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <label class="form-label me-2 mb-0">Payment Details:</label>
                                            <span class="badge bg-info text-dark text-break" style="white-space: normal;">
                                                Instructions: Ensure to send money/cash out correctly for Bkash, Nagad, or Rocket!
                                            </span>
                                        </div>
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary"
                                                    id="copyButton"
                                                    type="button"
                                                    onclick="copyToClipboard(paymentDetails[selectedPaymentMethod], selectedPaymentMethod)">
                                                <i class="fa fa-copy"></i> Copy
                                            </button>
                                            <input type="text" class="form-control" aria-label="Payment Details" id="paymentDetailsInput" readonly>
                                        </div>
                                        <div class="mt-2">
                                            <strong>Payable Total: <span id="payableTotalDropdown">${{ number_format($subtotal, 2) }}</span></strong>
                                        </div>
                                    </div>
                                </div>
                                <div id="upload-proof">
                                    <div class="card p-3">
                                        <h5>Step 2: Upload Proof of Payment</h5>
                                        <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot:</label>
                                        <input class="form-control" type="file" id="paymentScreenshot" name="proof" accept="image/*">
                                        @error('proof')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <img id="screenshotPreview" alt="Payment Screenshot" class="img-thumbnail mt-2 img-fluid d-none">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-5">
                            <div class="action-item">
                                @if(count($cartItems) > 0)
                                    <div class="action-top d-flex align-items-center justify-content-between">
                                        <span class="action-title">Product</span>
                                        <a href="{{ route('cart') }}">Edit Cart</a>
                                    </div>
                                    @foreach($cartItems as $item)
                                        @php
                                            $lineTotal = $item['product']->price * $item['quantity'];
                                        @endphp
                                        <div class="category-item">
                                            <div class="category-item-inner d-flex align-items-center justify-content-between">
                                                <div class="category-title-area">
                                                    <span class="category-title">{{ $item['product']->title }} × {{ $item['quantity'] }}</span>
                                                </div>
                                                <div class="price">${{ number_format($lineTotal, 2) }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="action-middle d-flex align-items-center justify-content-between">
                                        <span class="subtotal">Subtotal</span>
                                        <span class="total-price">${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                    <div class="action-bottom d-flex align-items-center justify-content-between">
                                        <span class="total">Total</span>
                                        <span class="total-price">${{ number_format($subtotal, 2) }}</span>
                                    </div>
                                @else
                                    <div class="empty-checkout text-center">
                                        <p>Your cart is empty.</p>
                                        <a href="{{ route('shop') }}" class="continue-shopping">
                                            <i class="fal fa-long-arrow-left"></i> Shopping more
                                        </a>
                                    </div>
                                @endif
                            </div>
                            <!-- Agree to terms and Place Order Button Inline -->
                            <div class="agree-terms mb-3">
                                <label for="agreeTerms" class="d-flex align-items-center">
                                    <input class="agree-terms-input mt-4" type="checkbox" value="1" id="agreeTerms" name="agreeTerms" required style="width: auto; margin-right: 5px;">
                                    <span style="vertical-align: middle;">I agree to the terms and conditions</span>
                                </label>
                            </div>
                            <button type="submit" class="place-order-btn">Place Order</button>
                        </div>
                    </div>
                </form>
            @else
                <div class="empty-checkout text-center">
                    <p>Your cart is empty.</p>
                    <a href="{{ route('shop') }}" class="continue-shopping">
                        <i class="fal fa-long-arrow-left"></i> Shopping more
                    </a>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let selectedPaymentMethod = '';
    const paymentDetails = {!! json_encode($paymentMethods->pluck('address', 'name')) !!};
    const paymentRates = {!! json_encode($paymentMethods->pluck('rate', 'name')) !!};
    const subtotal = {{ $subtotal }};

    function showPaymentInfo(paymentMethod) {
        selectedPaymentMethod = paymentMethod;
        const container = document.getElementById('payment-info-container');
        const paymentScreenshot = document.getElementById('paymentScreenshot');
        const paymentDetailsInput = document.getElementById('paymentDetailsInput');
        
        container.classList.remove('d-none');
        
        let multiplier = parseFloat(paymentRates[paymentMethod]) || 1;
        let payableTotal = subtotal * multiplier;
        document.getElementById('payableTotalDropdown').innerHTML = '$' + payableTotal.toFixed(2);
        
        // Set payment details
        if (paymentDetails[paymentMethod]) {
            paymentDetailsInput.value = paymentDetails[paymentMethod];
        }
        
        if (paymentMethod.toLowerCase() === 'wallet') {
            document.getElementById('payment-details').classList.add('d-none');
            document.getElementById('upload-proof').classList.add('d-none');
            paymentScreenshot.removeAttribute('required');
        } else {
            document.getElementById('payment-details').classList.remove('d-none');
            document.getElementById('upload-proof').classList.remove('d-none');
            paymentScreenshot.setAttribute('required', 'required');
        }
    }

    // Update form submission handler
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutForm = document.querySelector('.checkout-form');
        const paymentScreenshot = document.getElementById('paymentScreenshot');
        
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                const selectedPayment = document.querySelector('input[name="payment_option"]:checked');
                // Validate proof only if selected option is not "Wallet"
                if (selectedPayment && selectedPayment.value.toLowerCase() !== 'wallet' && (!paymentScreenshot.files || !paymentScreenshot.files[0])) {
                    e.preventDefault();
                    alert('Please upload payment proof');
                    return false;
                }
                return true;
            });
        }

        // Initialize payment method if there's a previously selected option
        const selectedPayment = document.querySelector('input[name="payment_option"]:checked');
        if (selectedPayment) {
            showPaymentInfo(selectedPayment.value);
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        var screenshotElem = document.getElementById('paymentScreenshot');
        if (screenshotElem) {
            screenshotElem.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const preview = document.getElementById('screenshotPreview');
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('d-none');
                    }
                    reader.readAsDataURL(file);
                } else {
                    preview.src = '#';
                    preview.classList.add('d-none');
                }
            });
        } else {
            console.error("Element 'paymentScreenshot' not found.");
        }

        // Set up delivery method change handlers
        const emailInput = document.getElementById('emailInput');
        const contactInput = document.getElementById('contactInput');
        const deliveryRadios = document.querySelectorAll('.delivery-method-radio');
        
        // Function to update required fields based on delivery method
        function updateRequiredFields() {
            const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
            
            if (selectedDelivery) {
                if (selectedDelivery.value === 'email') {
                    // Email delivery: email required, contact optional
                    emailInput.setAttribute('required', 'required');
                    contactInput.removeAttribute('required');
                    emailInput.placeholder = 'Email Address**';
                    contactInput.placeholder = 'Telegram/WhatsApp (Optional)';
                } else {
                    // WhatsApp/Telegram delivery: contact required, email optional
                    contactInput.setAttribute('required', 'required');
                    emailInput.removeAttribute('required');
                    contactInput.placeholder = 'Telegram/WhatsApp**';
                    emailInput.placeholder = 'Email Address (Optional)';
                }
            }
        }
        
        // Add event listeners to all delivery method radio buttons
        deliveryRadios.forEach(radio => {
            radio.addEventListener('change', updateRequiredFields);
        });
        
        // Initialize on page load
        updateRequiredFields();
    });

    function copyToClipboard(text, paymentMethod) {
        navigator.clipboard.writeText(text)
            .then(() => {
                var copyButton = document.getElementById('copyButton');
                var originalHTML = copyButton.innerHTML;
                copyButton.innerHTML = 'Copied!';
                setTimeout(() => {
                    copyButton.innerHTML = originalHTML;
                }, 1500);
            })
            .catch(err => {
                console.error('Could not copy text: ', err);
            });
    }
</script>
@endpush