@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
	<x-alert />

    <x-form 
        form-id="paymentMethodForm" 
        form-action="{{ route('payment-methods.store') }}" 
        method="POST"
        title="Create Payment Method"
        :discardRoute="route('payment-methods.index')"
		enctype="multipart/form-data"
    >
        {{-- Name input --}}
        <x-form.input 
            label="Name" 
            name="name" 
            :value="old('name')" 
        />

        {{-- Rate input --}}
        <x-form.input 
            label="Rate" 
            name="rate" 
            type="number"
            step="0.01"
            :value="old('rate')" 
        />

        {{-- Address input --}}
        <x-form.input 
            label="Address" 
            name="address" 
            :value="old('address')" 
        />

        {{-- Instruction input --}}
        <x-form.input 
            label="Instruction" 
            name="instruction" 
            :value="old('instruction')" 
        />

        {{-- image input --}}
        <x-form.files label="Image" name="image" />

        <x-form.files label="QR" name="qr" />

        {{-- Status select --}}
        <x-form.option 
            name="status" 
            label="Status"
            :options="['1' => 'Active', '0' => 'Inactive']"
        />
    </x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection