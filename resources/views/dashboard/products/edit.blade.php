@extends('dashboard.layouts.app')

@section('content')
<div class="container">
	<x-alert />
	
	<x-form 
		form-id="productForm" 
		form-action="{{ route('products.update', $product->id) }}" 
		method="PUT"
		title="Edit Product"
		:discardRoute="route('products.index')"
		enctype="multipart/form-data"
	>
		<!-- ...existing fields... -->
		<x-form.input 
			label="Title" 
			name="title" 
			:value="old('title', $product->title)" 
		/>
		<x-form.select 
			label="Category" 
			name="category_id" 
			:options="$categories" 
			selected="{{ old('category_id', $product->category_id) }}" 
			placeholder="Select Category" 
			option-label="title" 
			option-value="id" 
		/>
		<x-form.textarea 
			label="Description" 
			name="description"
		>
			{{ old('description', $product->description) }}
		</x-form.textarea>
		<x-form.input 
			label="Price" 
			name="price" 
			:value="old('price', $product->price)" 
		/>
		<x-form.input 
			label="Quantity" 
			name="quantity" 
			:value="old('quantity', $product->quantity)" 
		/>
		<!-- Images field -->
		<x-form.files 
			label="Product Images" 
			name="images[]" 
			:existingImages="$product->imagePaths" 
		/>
		<!-- ...existing code... -->
	</x-form>
</div>
@endsection

@push('scripts')
	<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endpush