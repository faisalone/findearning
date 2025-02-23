@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <x-form 
        form-id="categoryForm" 
        form-action="{{ route('categories.store') }}" 
        method="POST"
        title="Add New Category"
        :discardRoute="route('categories.index')"
        enctype="multipart/form-data"
    >
        {{-- ...existing fields... --}}
        <x-form.input label="Title" name="title" :value="old('title')" />
        <x-form.textarea label="Description" name="description">{{ old('description') }}</x-form.textarea>
        {{-- Single image field uses the updated file component --}}
        <x-form.files label="Image" name="image" />
        {{-- ...existing code... --}}
    </x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection