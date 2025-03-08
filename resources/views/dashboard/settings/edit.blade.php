@extends('dashboard.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Setting: {{ $setting->key }}</h1>
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
                    <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="key">Key</label>
                            <input type="text" class="form-control" id="key" name="key" value="{{ $setting->key }}" readonly>
                            <small class="form-text text-muted">The key cannot be changed after creation</small>
                        </div>

                        <div class="form-group">
                            <label for="value">Value</label>
                            <textarea class="form-control @error('value') is-invalid @enderror" id="value" name="value" rows="3">{{ old('value', $setting->value) }}</textarea>
                            <small class="form-text text-muted">The setting value (can be left empty)</small>
                            @error('value')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file mb-2">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                <label class="custom-file-label" for="image">Choose new file...</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- New Image Preview Container -->
                            <div id="imagePreviewContainer" class="mt-3" style="display: none;">
                                <p>New Image Preview:</p>
                                <img id="imagePreview" src="#" alt="New Image Preview" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                            
                            @if($setting->image)
                                <div class="mt-3">
                                    <p>Current Image:</p>
                                    <img src="{{ asset('storage/' . $setting->image) }}" alt="{{ $setting->key }}" class="img-thumbnail" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update Setting
                            </button>
                            <a href="{{ route('settings.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Setting Information</h6>
                </div>
                <div class="card-body">
                    <p><strong>Key:</strong> {{ $setting->key }}</p>
                    <p><strong>Created:</strong> {{ $setting->created_at->format('M d, Y') }}</p>
                    <p><strong>Last Updated:</strong> {{ $setting->updated_at->format('M d, Y h:i A') }}</p>
                    <hr>
                    <p>You can update the value or change the image associated with this setting.</p>
                    <p class="mb-0"><strong>Note:</strong> Empty values are allowed and will be stored as NULL.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Show file name in custom file input
        $("#image").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            
            // Image preview functionality
            var fileInput = this;
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    $("#imagePreview").attr("src", e.target.result);
                    $("#imagePreviewContainer").fadeIn();
                }
                
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                $("#imagePreviewContainer").fadeOut();
            }
        });
    });
</script>
@endsection
