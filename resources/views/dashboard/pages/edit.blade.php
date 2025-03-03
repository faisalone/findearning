@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid px-0 px-md-2">
    <x-alert />

    <x-form 
        form-id="pageEditForm" 
        form-action="{{ route('pages.update', $page) }}" 
        method="PUT"
        title="Edit Page"
        :discardRoute="route('pages.index')"
    >
        <x-form.input 
            label="Title" 
            name="title" 
            :value="old('title', $page->title)" 
        />

        <x-form.textarea 
            label="Content" 
            name="content"
        >
            {{ old('content', $page->content) }}
        </x-form.textarea>
        
        <x-form.option 
            name="status" 
            :options="['1' => 'Publish', '0' => 'Draft']"  
            label="Status"
            :selected="old('status', $page->status ? '1' : '0')"
        />

        <x-form.option 
            name="position" 
            :options="['1' => 'Information Pages', '2' => 'My Account Pages']" 
            label="Position"
            :selected="old('position', $page->position)"
        />
    </x-form>
</div>
@endsection
