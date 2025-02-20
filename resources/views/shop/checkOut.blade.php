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
			<form class="checkout-form" method="POST" action="{{ route('placeOrder') }}" enctype="multipart/form-data">
                @csrf
                <div class="row g-3 justify-content-between">
                    <label class="delivery-heading mb-3"><h3>Delivery Information:</h3></label>

                    <div class="col-xl-8 col-lg-7">
                        <!-- Shipping Options -->
                        <div class="shipping-options checkout-options mb-3">
                            <span class="shipping">Delivery Method</span>
                            <div class="btn-group d-flex justify-content-center gap-3" role="group">
                                <input type="radio" class="btn-check" name="delivery_method" id="emailDelivery" value="email" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="emailDelivery">
                                    <img src="{{ asset('assets/images/icons/mail.png') }}" alt="Email" class="delivery-icon"> Email
                                </label>
                                <input type="radio" class="btn-check" name="delivery_method" id="whatsappDelivery" value="whatsapp" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="whatsappDelivery">
                                    <img src="{{ asset('assets/images/icons/whatsapp.png') }}" alt="WhatsApp" class="delivery-icon"> WhatsApp
                                </label>
                                <input type="radio" class="btn-check" name="delivery_method" id="telegramDelivery" value="telegram" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="telegramDelivery">
                                    <img src="{{ asset('assets/images/icons/telegram.png') }}" alt="Telegram" class="delivery-icon"> Telegram
                                </label>
                            </div>
                        </div>
                        <!-- Delivery Information Fields -->
                        <div class="row">
                            <div class="col-12">
                                <div class="input-div">
                                    <input type="text" name="name" placeholder="Name**" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="input-div">
                                    <input type="text" name="contact" placeholder="Telegram/WhatsApp**" required>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="input-div">
                                    <input type="email" name="email" placeholder="Email Address**" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea id="orderNotes" name="order_notes" cols="80" rows="4" placeholder="Order notes (optional)"></textarea>
                            </div>
                        </div>
                        <!-- Payment Options -->
                        <div class="payment-options checkout-options mb-3">
                            <label class="mb-2">Select a payment option:</label>
                            <div class="btn-group d-flex flex-wrap justify-content-center gap-3" role="group">
                                <input type="radio" class="btn-check" name="payment_option" id="payeer" value="payeer" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="payeer" onclick="showPaymentInfo('payeer')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Payeer" class="payment-icon"> Payeer
                                </label>
                                <input type="radio" class="btn-check" name="payment_option" id="nagad" value="nagad" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="nagad" onclick="showPaymentInfo('nagad')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Nagad" class="payment-icon"> Nagad
                                </label>
                                <input type="radio" class="btn-check" name="payment_option" id="rocket" value="rocket" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="rocket" onclick="showPaymentInfo('rocket')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Rocket" class="payment-icon"> Rocket
                                </label>
                                <input type="radio" class="btn-check" name="payment_option" id="litecoin" value="litecoin" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="litecoin" onclick="showPaymentInfo('litecoin')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Litecoin" class="payment-icon"> Litecoin (litecoin network)
                                </label>
                                <input type="radio" class="btn-check" name="payment_option" id="bitcoin" value="bitcoin" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="bitcoin" onclick="showPaymentInfo('bitcoin')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Bitcoin" class="payment-icon"> Bitcoin
                                </label>
                                <input type="radio" class="btn-check" name="payment_option" id="binance" value="binance" required autocomplete="off">
                                <label class="btn btn-outline-secondary rounded-pill" for="binance" onclick="showPaymentInfo('binance')">
                                    <img src="{{ asset('assets/images/icons/payment.png') }}" alt="Binance" class="payment-icon"> Binance
                                </label>
                            </div>
                        </div>
						
                        <!-- Payment Details and Upload -->
                        <div id="payment-info-container" class="d-none">
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
                                    <strong>Total Amount: ${{ number_format($subtotal, 2) }}</strong>
                                </div>
                            </div>
                            <div class="card p-3">
                                <h5>Step 2: Upload Proof of Payment</h5>
                                <label for="paymentScreenshot" class="form-label">Upload Payment Screenshot:</label>
                                <input class="form-control" type="file" id="paymentScreenshot" name="proof" accept="image/*" required>
                                <img id="screenshotPreview" alt="Payment Screenshot" class="img-thumbnail mt-2 img-fluid d-none">
                            </div>
                        </div>
                    </div>

					<div class="col-xl-4 col-lg-5">
						<div class="action-item">
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
        </div>
    </div>

@endsection

@push('scripts')
<script>
    let selectedPaymentMethod = '';
    const paymentDetails = {
        'payeer': 'P12345678',
        'nagad': '01XXXXXXXXX',
        'rocket': '01XXXXXXXXX',
        'litecoin': 'LKJHGFDSAQWERTYUIOP',
        'bitcoin': '1234567890ABCDEFGHIJKL',
        'binance': 'BNBMNBVCXZASDFGHJKLQWERTYUIOP',
    };

    function showPaymentInfo(paymentMethod) {
        selectedPaymentMethod = paymentMethod;
        const container = document.getElementById('payment-info-container');
        container.classList.remove('d-none');
        document.getElementById('paymentDetailsInput').value = paymentDetails[paymentMethod];
    }

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