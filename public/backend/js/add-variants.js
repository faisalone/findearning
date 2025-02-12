document.addEventListener('DOMContentLoaded', function () {
	// Fetch and populate primary variant options
	fetch('/variants')
		.then(response => response.json())
		.then(data => {
			document.querySelectorAll('.variant-select').forEach(function (select) {
				populateVariantOptions(select, data);
			});
		})
		.catch(error => console.error('Error fetching primary variants:', error));

	// Handle add details form submission
	document.querySelectorAll('.addVariantsForm').forEach(function (form) {
		form.addEventListener('submit', function (event) {
			event.preventDefault();
			if (confirm('Are you sure you want to add these details?')) {
				var productId = form.getAttribute('data-product-id');
				var url = '/dashboard/products/' + productId + '/variants';
				var formData = new FormData(form);

				// Collect all selected variant IDs
				var variantIds = [];
				form.querySelectorAll('.variant-select').forEach(function (select) {
					if (select.value) {
						variantIds.push(select.value);
					}
				});

				if (variantIds.length > 0) {
					formData.set('variant', variantIds[variantIds.length - 1]);
				}

				fetch(url, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
					},
					body: formData
				})
					.then(response => {
						if (!response.ok) {
							throw new Error('Network response was not ok');
						}
						return response.json();
					})
					.then(data => {
						if (!data.success) {
							alert(data.message);
						} else {
							window.location.href = '/dashboard/products';
						}
					})
					.catch(error => {
						console.error('Error submitting form:', error);
					});
			}
		});
	});
});

function populateVariantOptions(select, variants, level = 0) {
	const defaultOption = document.createElement('option');
	defaultOption.value = '';
	defaultOption.textContent = 'Select new variant';
	select.appendChild(defaultOption);

	// Populate the dropdown
	variants.forEach(variant => {
		const option = document.createElement('option');
		option.value = variant.id;
		option.textContent = ' '.repeat(level * 4) + variant.title;
		select.appendChild(option);
	});

	// Add event listener for cascading dropdown
	select.addEventListener('change', function () {
		const selectedVariantId = this.value;

		// Remove cascading dropdowns at lower levels
		let nextSibling = this.nextElementSibling;
		while (nextSibling && nextSibling.classList.contains('variant-select')) {
			nextSibling.remove();
			nextSibling = this.nextElementSibling;
		}

		// Fetch and populate child variants if a valid selection is made
		if (selectedVariantId) {
			fetch(`/variants/${selectedVariantId}`)
				.then(response => response.json())
				.then(data => {
					if (data.children && data.children.length > 0) {
						const newSelect = document.createElement('select');
						newSelect.classList.add('form-control', 'variant-select', 'mt-2');
						this.parentNode.appendChild(newSelect);

						// Populate child dropdown
						populateVariantOptions(newSelect, data.children, level + 1);
					}
				})
				.catch(error => console.error('Error fetching child variants:', error));
		}
	});
}
