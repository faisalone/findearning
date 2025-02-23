@extends('dashboard.layouts.app')

@section('content')
<div class="container">
	<x-alert />

	<x-form 
		form-id="paymentMethodForm" 
		form-action="{{ route('payment-methods.update', $paymentMethod->id) }}" 
		method="POST"
		title="Edit Payment Method"
		:discardRoute="route('payment-methods.index')"
		enctype="multipart/form-data"
	>
		@method('PUT')
		
		{{-- Name input --}}
		<x-form.input 
			label="Name" 
			name="name" 
			:value="old('name', $paymentMethod->name)" 
		/>

		{{-- Rate input --}}
		<x-form.input 
			label="Rate" 
			name="rate" 
			type="number"
			step="0.01"
			:value="old('rate', $paymentMethod->rate)" 
		/>

		{{-- Address input --}}
		<x-form.input 
			label="Address" 
			name="address" 
			:value="old('address', $paymentMethod->address)" 
		/>

		{{-- Instruction input --}}
		<x-form.input 
			label="Instruction" 
			name="instruction" 
			:value="old('instruction', $paymentMethod->instruction)" 
		/>

		{{-- image input --}}
		<x-form.files label="Image" name="image" :existingImages="[$paymentMethod->imagePath]" />

		{{-- Status select --}}
		<x-form.option 
			name="status" 
			label="Status"
			:options="['1' => 'Active', '0' => 'Inactive']"
			:value="old('status', $paymentMethod->status)"
		/>
	</x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection
