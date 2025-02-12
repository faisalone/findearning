@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

	<x-form-heading 
		title="Editing Variants for Product: {{ $product->title }}" 
		discardRoute="{{ route('products.index') }}"
		formId="variantForm" />

	<!-- Variants Form -->
	<form id="variantForm" action="{{ route('products.storeVariant', $product) }}" method="POST">
		@csrf
		<!-- Variants Container -->
		<div id="variants-container">
				<!-- Variant Field Group with data-index -->
				<div class="variant-field row mb-3" data-index="0">
					@foreach($attributes as $attribute)
						<div class="col-12 col-md">
							<div class="form-group">
								<label for="attribute-{{ $attribute->id }}"> {{ $attribute->title }} </label>
								@if(count($attribute->values ?? []) > 0)
									<select name="variants[0][attributes][{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}" class="form-control">
										<option value="">-- None --</option>
										@foreach($attribute->values as $value)
											<option value="{{ $value->id }}">{{ $value->value }}</option>
										@endforeach
									</select>
								@else
									<input type="text" name="variants[0][attributes][{{ $attribute->id }}]" id="attribute-{{ $attribute->id }}" class="form-control">
								@endif
							</div>
						</div>
					@endforeach

					<div class="col-12 col-md">
						<div class="form-group">
							<label for="price_factor">Price Factor</label>
							<input type="number" name="variants[0][price_factor]" id="price_factor" class="form-control" step="any">
						</div>
					</div>

					<div class="col-12 col-md">
						<div class="form-group">
							<label for="quantity_factor">Quantity Factor</label>
							<input type="number" name="variants[0][quantity_factor]" id="quantity_factor" class="form-control" step="any">
						</div>
					</div>

					<!-- Buttons column -->
					<div class="col-12 col-md-auto d-flex align-items-end justify-content-center justify-content-md-end mt-2 mt-md-0">
						<button type="button" class="btn btn-sm btn-secondary btn-add me-1">
							<i class="bi bi-plus"></i>
						</button>
						<button type="button" class="btn btn-sm btn-danger btn-remove">
							<i class="bi bi-x"></i>
						</button>
					</div>
				</div>
			</div>
		<!-- Removed existing submit button markup -->
	</form>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
	const variantsContainer = document.getElementById('variants-container');
	const submitBtn = document.querySelector('button[type=submit][form="variantForm"]');

	// Update plus and remove buttons as before
	const updateButtons = () => {
		const groups = [...document.querySelectorAll('.variant-field')];
		const duplicateExists = !!document.querySelector('.variant-field.border.border-danger');
		groups.forEach(group => group.querySelector('.btn-remove').disabled = groups.length === 1);
		groups.forEach(group => {
			const plusBtn = group.querySelector('.btn-add');
			if(duplicateExists){
				plusBtn.disabled = true;
			} else {
				// Enable if any field has a value
				const anyFilled = [...group.querySelectorAll('input, select')].some(field => field.value.trim() !== '');
				plusBtn.disabled = !anyFilled;
			}
		});
	};

	const checkDuplicates = () => {
		const groups = [...document.querySelectorAll('.variant-field')];
		groups.forEach(group => group.classList.remove('border', 'border-danger', 'p-2'));
		const keys = groups.map(group => {
			const fields = [...group.querySelectorAll('input, select')]
				.filter(field => !/(price_factor|quantity_factor)/.test(field.name));
			return fields.map(f => f.value.trim()).join('|');
		});
		groups.forEach((group, i) => {
			if (keys[i] && keys.filter(k => k === keys[i]).length > 1) {
				group.classList.add('border','border-danger','p-2');
			}
		});
		submitBtn && (submitBtn.disabled = !!document.querySelector('.variant-field.border.border-danger'));
		updateButtons();
	};

	// Update input names of a clone by replacing the old index with newIndex
	const updateCloneIndices = (clone, newIndex) => {
		clone.setAttribute('data-index', newIndex);
		clone.querySelectorAll('input, select').forEach(input => {
			if(input.name){
				input.name = input.name.replace(/variants\[\d+\]/, 'variants['+ newIndex +']');
			}
		});
	};

	const cloneAndClear = currentGroup => {
		const clone = currentGroup.cloneNode(true);
		// Reset values in the clone
		clone.querySelectorAll('input').forEach(input => input.value = '');
		clone.querySelectorAll('select').forEach(select => select.selectedIndex = 0);
		// New index equals current count
		const newIndex = document.querySelectorAll('.variant-field').length;
		updateCloneIndices(clone, newIndex);
		// Insert immediately after the current group
		currentGroup.insertAdjacentElement('afterend', clone);
		checkDuplicates();
	};

	variantsContainer.addEventListener('click', evt => {
		const addBtn = evt.target.closest('.btn-add');
		const removeBtn = evt.target.closest('.btn-remove');
		if(addBtn){
			cloneAndClear(addBtn.closest('.variant-field'));
		} else if(removeBtn){
			const group = removeBtn.closest('.variant-field');
			if(variantsContainer.querySelectorAll('.variant-field').length > 1){
				group.remove();
				checkDuplicates();
			}
		}
	});

	['input','change'].forEach(e => {
		variantsContainer.addEventListener(e, checkDuplicates);
	});

	document.querySelector('form').addEventListener('submit', e => {
		checkDuplicates();
		if(document.querySelector('.variant-field.border.border-danger')){
			e.preventDefault();
		}
	});

	checkDuplicates();
});
</script>
@endsection