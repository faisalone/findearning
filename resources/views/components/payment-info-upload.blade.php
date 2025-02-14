{{-- filepath: /d:/Oyelab/Oyelab/weiboo/resources/components/payment-info-upload.blade.php --}}

<div class="card p-3 mb-3">
    <h5>Step 1: Payment</h5>
    <div class="d-flex flex-wrap align-items-center">
        <label class="form-label me-2 mb-0">Payment Details:</label>
        <span class="badge bg-info text-dark text-break" style="white-space: normal;">
            Instructions: Ensure to send money/cash out correctly for Bkash, Nagad, or Rocket!
        </span>
    </div>
    <div class="mt-2 input-group">
        <button class="btn btn-outline-secondary"
                id="copyButton{{ $paymentMethod }}"
                type="button"
                onclick="copyToClipboard('{{ $paymentDetails[$paymentMethod] ?? '' }}', '{{ $paymentMethod }}')">
            <i class="fa fa-copy"></i> Copy
        </button>
        <input type="text" class="form-control" aria-label="Payment Details" value="{{ $paymentDetails[$paymentMethod] ?? '' }}" readonly>
    </div>
</div>

<div class="card p-3">
    <h5>Step 2: Upload Proof of Payment</h5>
    <label for="paymentScreenshot{{ $paymentMethod }}" class="form-label">Upload Payment Screenshot:</label>
    <input class="form-control" type="file" id="paymentScreenshot{{ $paymentMethod }}" name="payment_screenshot_{{ $paymentMethod }}" accept="image/*">
    <img id="screenshotPreview{{ $paymentMethod }}" alt="Payment Screenshot" class="img-thumbnail mt-2 img-fluid d-none">

    @push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var screenshotElem = document.getElementById('paymentScreenshot{{ $paymentMethod }}');
            if (screenshotElem) {
                screenshotElem.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('screenshotPreview{{ $paymentMethod }}');
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
                console.error("Element 'paymentScreenshot{{ $paymentMethod }}' not found.");
            }
        });

        function copyToClipboard(text, paymentMethod) {
            navigator.clipboard.writeText(text)
                .then(() => {
                    var copyButton = document.getElementById('copyButton' + paymentMethod);
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
</div>
