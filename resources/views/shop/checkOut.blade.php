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
                {{-- The $message variable below is provided by the @error directive --}}
                @error('stock_error')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                
                <form class="checkout-form" method="POST" action="{{ route('placeOrder') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- New common error block --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6 col-md-6">
                                    <div class="input-div">
                                        <input type="text" id="contactInput" name="contact" placeholder="Telegram/WhatsApp**" value="{{ old('contact') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <div class="input-div">
                                        <input type="email" id="emailInput" name="email" placeholder="Email Address**" value="{{ old('email') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <textarea id="orderNotes" name="order_notes" cols="80" rows="4" placeholder="Order notes (optional)">{{ old('order_notes') }}</textarea>
                                </div>
                            </div>
                            <!-- Replace Payment Method Options -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="mb-2">Select a Payment Method:</label>
									<div class="d-flex gap-2 payment-options-container" role="group">
										<input type="radio" class="btn-check" name="payment_option" id="paymentEwallet" value="Wallet" autocomplete="off" {{ old('payment_option') == 'Wallet' ? 'checked' : '' }} required>
										<label class="btn btn-outline-secondary rounded d-flex align-items-center justify-content-center" for="paymentEwallet">
											<img src="{{ asset('assets/images/fav.png') }}" alt="eWallet" class="me-2"> My Wallet
										</label>
										<input type="radio" class="btn-check" id="paymentCrypto" value="crypto" autocomplete="off" {{ old('payment_option') == 'crypto' ? 'checked' : '' }}>
										<label class="btn btn-outline-secondary rounded d-flex align-items-center justify-content-center" for="paymentCrypto">
											<img src="https://img.icons8.com/fluency/48/000000/bitcoin.png" alt="Crypto" class="me-2"> Crypto
										</label>
									</div>
                                </div>
                            </div>
                            <!-- New Crypto Payment Methods Options (centered) -->
                            <div id="cryptoOptionsContainer" class="mt-3 text-center" style="display:none;">
                                <label class="mb-2 d-block">Select a Crypto Payment Method:</label>
                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                    @foreach($paymentMethods as $method)
                                        <input type="radio" class="btn-check crypto-method" name="payment_option" id="cryptoMethod{{$method->id}}"
                                            value="{{ $method->name }}" autocomplete="off"
                                            data-address="{{ $method->address }}"
                                            data-instruction="{{ $method->instruction }}"
                                            data-exchange="{{ $method->rate }}"
                                            data-qr="{{ $method->qr_path }}">
                                        <label class="btn btn-outline-secondary rounded d-flex align-items-center" for="cryptoMethod{{$method->id}}">
                                            <img src="{{ $method->image_path }}" alt="{{ $method->name }}" class="me-2" style="width:2.2em; height:2.2em;"> {{ $method->name }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Crypto Payment Method Information Panel (modified) -->
                            <div id="cryptoInfo" class="mt-3" style="display:none;">
                                <div class="card crypto-details-card mx-auto">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <!-- QR Code Column: center aligned -->
                                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                                <img id="cryptoQr" src="" alt="QR Code" class="img-fluid" style="max-height:250px;">
                                            </div>
                                            <!-- Info Column -->
                                            <div class="col-md-6">
												<strong>Payable Amount:</strong> {{ number_format($subtotal, 2) }} USDT
												<div class="mb-3 d-flex align-items-center p-2 border border-primary rounded bg-light">
													<label class="form-label me-2 fw-bold text-primary" style="margin-bottom:0;"><strong>Address:</strong></label>
													<span id="cryptoAddressBadge" class="text-primary flex-grow-1 text-start px-2" style="line-height:1.5;"></span>
													<button class="btn btn-outline-primary btn-sm ms-2" type="button" id="copyAddressBtn" style="line-height:1;">Copy</button>
													<span id="copyTooltip" class="copy-tooltip text-success" style="display:none;">Copied!</span>
												</div>
                                                <p class="bg-warning card-text"><strong class="text-dark">Instructions:</strong> <span id="cryptoInstructions"></span></p>
                                                <p class="card-text">
                                                    <span class="px-1 rounded">Exchange Rate: 1 USD = 1 USDT</span>
                                                </p>
                                                <!-- New Proof Upload Field with Preview -->
                                                <div class="proof-upload-container mt-3">
                                                    <label id="proofUploadLabel" for="proofUpload" class="form-label"><strong>Upload Payment Proof:</strong></label>
                                                    <input type="file" id="proofUpload" name="proof" accept="image/*">
                                                    <img id="proofPreview" src="" alt="Image Preview" style="max-width:100%; display:none; margin-top:10px;">
                                                </div>
                                            </div>
                                        </div>
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
    // Update form submission and delivery method change handlers only.
    document.addEventListener('DOMContentLoaded', function() {
        const checkoutForm = document.querySelector('.checkout-form');
        
        if (checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                return true;
            });
        }
    
        // Set up delivery method change handlers
        const emailInput = document.getElementById('emailInput');
        const contactInput = document.getElementById('contactInput');
        const deliveryRadios = document.querySelectorAll('.delivery-method-radio');
        
        function updateRequiredFields() {
            const selectedDelivery = document.querySelector('input[name="delivery_method"]:checked');
            if (selectedDelivery) {
                if (selectedDelivery.value === 'email') {
                    emailInput.setAttribute('required', 'required');
                    contactInput.removeAttribute('required');
                    emailInput.placeholder = 'Email Address**';
                    contactInput.placeholder = 'Telegram/WhatsApp (Optional)';
                } else {
                    contactInput.setAttribute('required', 'required');
                    emailInput.removeAttribute('required');
                    contactInput.placeholder = 'Telegram/WhatsApp**';
                    emailInput.placeholder = 'Email Address (Optional)';
                }
            }
        }
        
        deliveryRadios.forEach(radio => {
            radio.addEventListener('change', updateRequiredFields);
        });
        
        // Initialize on page load
        updateRequiredFields();
    });

    // Toggle crypto options based on primary payment method
    const paymentCrypto = document.getElementById('paymentCrypto');
    const paymentEwallet = document.getElementById('paymentEwallet');
    const cryptoOptionsContainer = document.getElementById('cryptoOptionsContainer');
    const cryptoInfo = document.getElementById('cryptoInfo');

    function toggleCryptoOptions() {
        if (paymentCrypto.checked) {
            cryptoOptionsContainer.style.display = 'block';
            // Reset label to default when crypto option is not yet chosen
            document.getElementById('proofUploadLabel').innerHTML = '<strong>Upload Payment Proof:</strong>';
        } else {
            cryptoOptionsContainer.style.display = 'none';
            cryptoInfo.style.display = 'none';
            document.querySelectorAll('.crypto-method').forEach(radio => radio.checked = false);
            document.getElementById('proofUpload').removeAttribute('required');
            document.getElementById('proofUploadLabel').innerHTML = '<strong>Upload Payment Proof:</strong>';
        }
    }
    paymentCrypto.addEventListener('change', toggleCryptoOptions);
    paymentEwallet.addEventListener('change', toggleCryptoOptions);

    // Handle crypto method selection
    document.querySelectorAll('.crypto-method').forEach(function(radio) {
        radio.addEventListener('change', function() {
            const address = radio.dataset.address;
            const instruction = radio.dataset.instruction;
            const exchange = radio.dataset.exchange; // no longer used
            const qr = radio.dataset.qr;
            document.getElementById('cryptoAddressBadge').textContent = address;
            document.getElementById('cryptoInstructions').textContent = instruction;
            // Set static exchange rate text.
            document.getElementById('cryptoQr').src = qr;
            cryptoInfo.style.display = 'block';
            // Set proof field as required and update label text to indicate requirement
            document.getElementById('proofUpload').setAttribute('required', 'required');
            document.getElementById('proofUploadLabel').innerHTML = '<strong>Upload Payment Proof*:</strong>';
        });
    });
    // Copy address functionality (updated)
    document.getElementById('copyAddressBtn').addEventListener('click', function() {
        const badge = document.getElementById('cryptoAddressBadge');
        const text = badge.textContent.trim();
        if(navigator.clipboard) {
            navigator.clipboard.writeText(text);
        }
        const tooltip = document.getElementById('copyTooltip');
        tooltip.style.display = 'inline-block';
        setTimeout(() => {
            tooltip.style.display = 'none';
        }, 500);
    });

    // Add image upload preview for payment proof
    document.getElementById('proofUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('proofPreview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
<!-- Custom CSS for tooltip and embossed effect -->
<style>
  .crypto-details-card {
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      border: none;
      background-color: #fff;
  }
  .input-group {
      position: relative;
  }
  .copy-tooltip {
      position: absolute !important;
      right: -2rem !important; /* Force tooltip to appear after the copy button */
      transform: translateY(-50%) !important;
      font-size: 0.9rem !important;
      z-index: 9999 !important;
      background: #fff;
      padding: 0.2rem 0.5rem;
      border-radius: 0.3rem;
      box-shadow: 0 1px 3px rgba(0,0,0,0.2);
      pointer-events: none;
  }
  @media (max-width: 767.98px) {
    .responsive-input-group {
      flex-direction: column !important;
      align-items: center;
    }
    .responsive-input-group .form-control,
    .responsive-input-group .btn {
      width: 100%;
      margin-bottom: .5rem;
    }
    .responsive-input-group .btn {
      margin-bottom: 0;
    }
    .copy-tooltip {
      position: static !important;
      transform: none !important;
      margin-top: -0.3rem;
    }
  }
  #cryptoAddressBadge {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
      max-width: 100%; /* Ensure it doesn't exceed parent */
  }
  /* Fix for payment method container */
  .payment-options-container {
      max-width: 100%;
      overflow: hidden;
      flex-wrap: wrap;
  }
  
  .payment-options-container .btn {
      width: auto;
      white-space: nowrap;
      flex: 1 1 auto;
      min-width: 120px;
      max-width: calc(50% - 0.5rem); /* Account for the gap */
  }
  /* Fix for the CSS conflict with btn-check radios */
  .rts-checkout-section .checkout-form input:not([type="radio"]):not([type="checkbox"]),
  .rts-checkout-section .checkout-form select,
  .rts-checkout-section .checkout-form textarea {
      width: 100%;
      padding: 17px 30px;
      border-radius: 6px;
      border: 1px solid #e3e3e3;
      margin-bottom: 25px;
      outline: none;
      transition: box-shadow 300ms;
      font-size: 16px;
      color: #777777;
  }
  
  /* Preserve the radio buttons' Bootstrap styling */
  .btn-check {

      width: auto !important; /* Override the 100% width */
  }
</style>