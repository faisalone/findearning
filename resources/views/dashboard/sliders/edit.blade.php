{{-- filepath: /c:/Users/USER/Desktop/Oyelab/findearning/resources/views/dashboard/sliders/edit.blade.php --}}
@extends('dashboard.layouts.app')

@section('content')
<div class="container">
	<x-form 
		form-id="sliderForm" 
		form-action="{{ route('sliders.update', $slider->id) }}" 
		method="PUT"
		title="Edit Slider: {{ $slider->title }}"
		:discardRoute="route('sliders.index')"
		enctype="multipart/form-data"
	>
		<x-form.input label="Title" name="title" :value="$slider->title" />
		<x-form.files label="Image" name="image" :existingImages="[$slider->imagePath]" />
	</x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection
