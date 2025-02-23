@extends('dashboard.layouts.app')

@section('content')
<div class="container">
    <x-form 
        form-id="settingsForm" 
        form-action="{{ route('settings.store') }}" 
        method="POST"
        title="Site Settings"
        :discardRoute="route('dashboard')"
        enctype="multipart/form-data"
    >
        <x-form.input 
            label="Site Name" 
            name="settings[title]" 
            :value="App\Models\Setting::get('title')" 
        />

        <x-form.input 
            label="Site Email" 
            name="settings[email]" 
            type="email"
            :value="App\Models\Setting::get('email')" 
        />

        <x-form.textarea 
            label="Site Description" 
            name="settings[description]"
        >{{ App\Models\Setting::get('description') }}</x-form.textarea>

        <x-form.textarea 
            label="Meta Keywords" 
            name="settings[keywords]"
            placeholder="Enter keywords separated by commas"
        >{{ App\Models\Setting::get('keywords') }}</x-form.textarea>

        <x-form.files 
            label="Favicon" 
            name="settings[favicon]" 
            :existingImages="[App\Models\Setting::get('favicon')]"
        />

        <x-form.files 
            label="OG Image" 
            name="settings[og-image]" 
            :existingImages="[App\Models\Setting::get('og-image')]"
        />
    </x-form>
</div>
<script src="{{ asset('backend/js/simple-image-uploader.js') }}"></script>
@endsection


