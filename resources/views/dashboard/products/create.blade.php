@extends('dashboard.layouts.app')

@section('content')
<div class="container">
	<x-alert />
	
	<x-form 
		form-id="productForm" 
		form-action="{{ route('products.store') }}" 
		method="POST"
		title="Add New Product"
		:discardRoute="route('products.index')"
		enctype="multipart/form-data"
	>
		<!-- ...existing fields... -->
		<x-form.input 
			label="Title" 
			name="title" 
			:value="old('title')" 
		/>
		<x-form.select 
			label="Category" 
			name="category_id" 
			:options="$categories" 
			selected="{{ old('category_id') }}" 
			placeholder="Select Category" 
			option-label="title" 
			option-value="id" 
		/>
		<x-form.textarea 
			label="Description" 
			name="description"
		>
			{{ old('description') }}
		</x-form.textarea>
		<x-form.input 
			label="Price" 
			name="price" 
			:value="old('price', '0.00')" 
		/>
		<x-form.input 
			label="Quantity" 
			name="quantity" 
			:value="old('quantity')" 
		/>
		<!-- Images: remove the id so the component uses its dynamic default -->
		<x-form.files 
			label="Product Images" 
			name="images[]" 
		/>
		<!-- ...existing code... -->
	</x-form>
</div>
@endsection

@push('scripts')
	<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endpush