document.addEventListener('DOMContentLoaded', function() {
    // Cart functionality
    const visibleQtyInput = document.getElementById('quantity-input');
    const form = document.getElementById('add-to-cart-form');
    const actionTypeInput = document.getElementById('action-type');

    // Add to Cart button handler
    document.getElementById('add-to-cart-btn')?.addEventListener('click', function () {
        actionTypeInput.value = 'add-to-cart';
        document.getElementById('hidden-quantity').value = visibleQtyInput.value;

        let formData = new FormData(form);
        fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (document.getElementById('cart-count')) {
                    document.getElementById('cart-count').textContent = data.count;
                }
                if (document.getElementById('mobile-cart-count')) {
                    document.getElementById('mobile-cart-count').textContent = data.count;
                }
            })
            .catch(error => console.error('Error:', error));
    });

    // Buy Now button handler
    document.getElementById('buy-now-btn')?.addEventListener('click', function () {
        actionTypeInput.value = 'buy-now';
        document.getElementById('hidden-quantity').value = visibleQtyInput.value;

        // Submit the form and redirect to checkout
        form.submit();
    });
    
    // Review modal functionality
    // Connect "Rate This Product" button to modal
    const rateProductBtn = document.getElementById('rate-product-btn');
    if (rateProductBtn) {
        rateProductBtn.addEventListener('click', function() {
            var reviewModal = new bootstrap.Modal(document.getElementById('addReviewModal'));
            reviewModal.show();
        });
    }
    
    // Star rating functionality
    const ratingStars = document.querySelectorAll('.rating-star-input');
    const ratingValueInput = document.getElementById('ratingValue');
    
    if (ratingStars.length > 0 && ratingValueInput) {
        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const value = this.getAttribute('data-value');
                ratingValueInput.value = value;
                
                // Update stars UI
                ratingStars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue <= value) {
                        s.querySelector('i').className = 'fas fa-star text-warning';
                    } else {
                        s.querySelector('i').className = 'far fa-star';
                    }
                });
            });
            
            // Hover effects
            star.addEventListener('mouseenter', function() {
                const value = this.getAttribute('data-value');
                
                ratingStars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue <= value) {
                        s.querySelector('i').className = 'fas fa-star text-warning';
                    }
                });
            });
            
            star.addEventListener('mouseleave', function() {
                const currentValue = ratingValueInput.value;
                
                ratingStars.forEach(s => {
                    const starValue = s.getAttribute('data-value');
                    if (starValue <= currentValue) {
                        s.querySelector('i').className = 'fas fa-star text-warning';
                    } else {
                        s.querySelector('i').className = 'far fa-star';
                    }
                });
            });
        });
    }
    
    // Image preview functionality
    const reviewImageInput = document.getElementById('reviewImage');
    if (reviewImageInput) {
        reviewImageInput.addEventListener('change', function(event) {
            const imagePreview = document.getElementById('imagePreview');
            if (event.target.files.length > 0) {
                imagePreview.classList.remove('d-none');
                imagePreview.src = URL.createObjectURL(event.target.files[0]);
            } else {
                imagePreview.classList.add('d-none');
            }
        });
    }
});
