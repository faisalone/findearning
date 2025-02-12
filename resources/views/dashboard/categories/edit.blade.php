{{-- filepath: /c:/Users/USER/Desktop/Oyelab/findearning/resources/views/dashboard/categories/edit.blade.php --}}
@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <x-form 
        form-id="categoryForm" 
        form-action="{{ route('categories.update', $category->id) }}" 
        method="PUT"
        title="Edit Category: {{ $category->title }}"
        :discardRoute="route('categories.index')"
        enctype="multipart/form-data"
    >
        {{-- ...existing fields... --}}
        <x-form.input label="Title" name="title" :value="$category->title" />
        <x-form.textarea label="Description" name="description">{{ $category->description }}</x-form.textarea>
        {{-- Single image field using the updated file component --}}
        <x-form.files label="Image" name="image" :existingImages="[$category->imagePath]" />
        {{-- ...existing code... --}}
    </x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection