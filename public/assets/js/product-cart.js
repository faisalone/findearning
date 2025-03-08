document.addEventListener("DOMContentLoaded", function () {
    // Add CSS for disabled buttons
    const style = document.createElement('style');
    style.textContent = '.btn-disabled { opacity: 0.5; cursor: not-allowed; }';
    document.head.appendChild(style);
    
    // Get DOM elements
    const quantityInput = document.getElementById('quantity-input');
    const hiddenQuantityInput = document.getElementById('hidden-quantity');
    const minusBtn = document.querySelector('.button .minus').parentElement;
    const plusBtn = document.querySelector('.button.plus');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const buyNowBtn = document.getElementById('buy-now-btn');

    // Get product stock information
    let productStock = 0;
    const stockElement = document.querySelector('.stock');
    
    if (stockElement) {
        // Get actual stock from data attribute
        if (stockElement.hasAttribute('data-stock')) {
            productStock = parseInt(stockElement.getAttribute('data-stock'));
        } else {
            // Fallback to the old method if data attribute isn't available
            if (stockElement.classList.contains('text-success')) {
                productStock = 10; // Default fallback value
            } else if (stockElement.classList.contains('text-warning')) {
                const stockText = stockElement.textContent;
                const stockMatch = stockText.match(/\d+/);
                if (stockMatch) {
                    productStock = parseInt(stockMatch[0]);
                }
            } else if (stockElement.classList.contains('text-danger')) {
                productStock = 0;
            }
        }
    }

    // Initialize - disable controls if out of stock
    function initializeStockState() {
        if (productStock <= 0) {
            // Disable everything if out of stock
            quantityInput.disabled = true;
            minusBtn.disabled = true;
            plusBtn.disabled = true;
            addToCartBtn.disabled = true;
            buyNowBtn.disabled = true;
            
            // Add visual indication that controls are disabled
            addToCartBtn.classList.add('btn-disabled');
            buyNowBtn.classList.add('btn-disabled');
            minusBtn.classList.add('btn-disabled');
            plusBtn.classList.add('btn-disabled');
        } else {
            // Initially check plus button state based on current quantity
            updatePlusButtonState();
        }
    }

    // Function to update the plus button state
    function updatePlusButtonState() {
        const currentQty = parseInt(quantityInput.value);
        if (currentQty >= productStock) {
            plusBtn.disabled = true;
            plusBtn.classList.add('btn-disabled');
        } else {
            plusBtn.disabled = false;
            plusBtn.classList.remove('btn-disabled');
        }
    }

    // Function to update both quantity inputs
    function updateQuantity(newValue) {
        // Ensure quantity is between 1 and available stock
        newValue = Math.max(1, Math.min(newValue, productStock));
        
        // Update visible and hidden inputs
        quantityInput.value = newValue;
        hiddenQuantityInput.value = newValue;
        
        // Update button states
        updatePlusButtonState();
    }

    // Event listener for minus button
    minusBtn.addEventListener('click', function() {
        if (productStock <= 0) return; // Don't do anything if out of stock
        
        const currentQty = parseInt(quantityInput.value);
        if (currentQty > 1) {
            updateQuantity(currentQty - 1);
        }
    });

    // Event listener for plus button
    plusBtn.addEventListener('click', function() {
        if (productStock <= 0) return; // Don't do anything if out of stock
        
        const currentQty = parseInt(quantityInput.value);
        if (currentQty < productStock) {
            updateQuantity(currentQty + 1);
        }
    });

    // Event listener for direct input
    quantityInput.addEventListener('change', function() {
        let newValue = parseInt(this.value) || 1; // Default to 1 if NaN
        updateQuantity(newValue);
    });

    // Initialize the stock state on page load
    initializeStockState();

    // Cart functionality
    const visibleQtyInput = document.getElementById("quantity-input");
    const form = document.getElementById("add-to-cart-form");
    const actionTypeInput = document.getElementById("action-type");

    // Add to Cart button handler - SINGLE EVENT LISTENER
    document
        .getElementById("add-to-cart-btn")
        ?.addEventListener("click", function () {
            if (productStock <= 0) return; // Don't do anything if out of stock
            
            actionTypeInput.value = "add-to-cart";
            document.getElementById("hidden-quantity").value = visibleQtyInput.value;

            let formData = new FormData(form);
            fetch(form.action, {
                method: "POST",
                headers: { "X-Requested-With": "XMLHttpRequest" },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (document.getElementById("cart-count")) {
                        document.getElementById("cart-count").textContent =
                            data.count;
                    }
                    if (document.getElementById("mobile-cart-count")) {
                        document.getElementById(
                            "mobile-cart-count"
                        ).textContent = data.count;
                    }
                })
                .catch((error) => console.error("Error:", error));
        });

    // Buy Now button handler
    document
        .getElementById("buy-now-btn")
        ?.addEventListener("click", function () {
            if (productStock <= 0) return; // Don't do anything if out of stock
            
            actionTypeInput.value = "buy-now";
            document.getElementById("hidden-quantity").value = visibleQtyInput.value;

            // Submit the form and redirect to checkout
            form.submit();
        });

    // Review modal functionality
    // Connect "Rate This Product" button to modal
    const rateProductBtn = document.getElementById("rate-product-btn");
    if (rateProductBtn) {
        rateProductBtn.addEventListener("click", function () {
            var reviewModal = new bootstrap.Modal(
                document.getElementById("addReviewModal")
            );
            reviewModal.show();
        });
    }

    // Star rating functionality
    const ratingStars = document.querySelectorAll(".rating-star-input");
    const ratingValueInput = document.getElementById("ratingValue");

    if (ratingStars.length > 0 && ratingValueInput) {
        ratingStars.forEach((star) => {
            star.addEventListener("click", function () {
                const value = this.getAttribute("data-value");
                ratingValueInput.value = value;

                // Update stars UI
                ratingStars.forEach((s) => {
                    const starValue = s.getAttribute("data-value");
                    if (starValue <= value) {
                        s.querySelector("i").className =
                            "fas fa-star text-warning";
                    } else {
                        s.querySelector("i").className = "far fa-star";
                    }
                });
            });

            // Hover effects
            star.addEventListener("mouseenter", function () {
                const value = this.getAttribute("data-value");

                ratingStars.forEach((s) => {
                    const starValue = s.getAttribute("data-value");
                    if (starValue <= value) {
                        s.querySelector("i").className =
                            "fas fa-star text-warning";
                    }
                });
            });

            star.addEventListener("mouseleave", function () {
                const currentValue = ratingValueInput.value;

                ratingStars.forEach((s) => {
                    const starValue = s.getAttribute("data-value");
                    if (starValue <= currentValue) {
                        s.querySelector("i").className =
                            "fas fa-star text-warning";
                    } else {
                        s.querySelector("i").className = "far fa-star";
                    }
                });
            });
        });
    }

    // Image preview functionality
    const reviewImageInput = document.getElementById("reviewImage");
    if (reviewImageInput) {
        reviewImageInput.addEventListener("change", function (event) {
            const imagePreview = document.getElementById("imagePreview");
            if (event.target.files.length > 0) {
                imagePreview.classList.remove("d-none");
                imagePreview.src = URL.createObjectURL(event.target.files[0]);
            } else {
                imagePreview.classList.add("d-none");
            }
        });
    }
});
