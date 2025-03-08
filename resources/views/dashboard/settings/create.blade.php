@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Setting</h1>
        <a href="{{ route('settings.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Settings
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Setting Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="key">Key <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key') }}" required>
                            <small class="form-text text-muted">Use a descriptive name (e.g., site_title, contact_email)</small>
                            @error('key')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">Value</label>
                            <textarea class="form-control @error('value') is-invalid @enderror" id="value" name="value" rows="3">{{ old('value') }}</textarea>
                            <small class="form-text text-muted">The setting value (can be left empty)</small>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">Choose file...</label>
                                <small class="form-text text-muted">Upload an image if this setting requires one (optional)</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Save Setting
                            </button>
                            <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Setting Information</h6>
                </div>
                <div class="card-body">
                    <p>Settings are used to store configuration information for your site.</p>
                    <hr>
                    <h6 class="font-weight-bold">Common Settings</h6>
                    <ul class="mb-3">
                        <li>url - Website URL</li>
                        <li>title - Website Title</li>
                        <li>description - Site Description</li>
                        <li>keywords - SEO Keywords</li>
                        <li>email - Contact Email</li>
                        <li>whatsapp - WhatsApp Number</li>
                        <li>telegram - Telegram Username</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
