@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
	<x-form 
		form-id="sliderForm" 
		form-action="{{ route('sliders.store') }}" 
		method="POST"
		title="Add New Slider"
		:discardRoute="route('sliders.index')"
		enctype="multipart/form-data"
	>
		<x-form.input label="Title" name="title" :value="old('title')" />
		<x-form.files label="Image" name="image" />
	</x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection
