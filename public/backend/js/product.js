document.querySelectorAll('.toggle-status').forEach(function (checkbox) {
	checkbox.addEventListener('change', function () {
		if (confirm('Are you sure you want to change the status of this product?')) {
			var productId = this.getAttribute('data-id');
			var status = this.checked ? 1 : 0;

			fetch('/dashboard/products/' + productId + '/status', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({ status: status })
			}).then(response => response.json())
				.then(data => {
					if (!data.success) {
						alert(data.message);
					} else {
						document.getElementById('success-text').innerText = data.message;
						document.getElementById('success-message').classList.remove('d-none');
					}
				});
		} else {
			this.checked = !this.checked;
		}
	});
});
