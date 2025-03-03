document.addEventListener('DOMContentLoaded', function () {
    const container = document.querySelector('.products-container');
    if (!container) return;

    let currentPage = +container.dataset.currentPage;
    let lastPage   = +container.dataset.lastPage;
    let isLoading   = false;
    const spinner   = document.querySelector('.loading-spinner');

    const loadMoreProducts = async () => {
        if (currentPage >= lastPage || isLoading) return;
        isLoading = true;
        spinner.style.display = 'block';
        try {
            const url = new URL(window.location.href);
            url.searchParams.set('page', currentPage + 1);
            const response = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await response.json();
            container.insertAdjacentHTML('beforeend', data.html);

            // Update currentPage / lastPage
            if (data.currentPage && data.lastPage) {
                currentPage = data.currentPage;
                lastPage = data.lastPage;
            }
        } catch(e) {
            console.error(e);
        } finally {
            spinner.style.display = 'none';
            isLoading = false;
            observeLastProduct();
        }
    };

    // Observe the last product in the container to trigger loading
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                loadMoreProducts();
            }
        });
    }, { rootMargin: '200px' });

    function observeLastProduct() {
        if (!container.lastElementChild) return;
        observer.observe(container.lastElementChild);
    }

    observeLastProduct();
});
