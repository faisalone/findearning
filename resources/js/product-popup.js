document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll('.view-product-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const productId = btn.dataset.productId;
            fetch(`/ajax/product-details/${productId}`)
                .then(r => r.json())
                .then(data => {
                    // ...update popup content with data...
                    document.querySelector('.product-details-popup-wrapper')
                            .classList.add('active');
                });
        });
    });
});
