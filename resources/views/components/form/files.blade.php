@props(['name', 'label', 'existingImages' => null])
@php 
    // Use provided id attribute or generate from name
    $inputId = $attributes->get('id') ?? str_replace('[]', '', $name);
    $previewId = $inputId . '-preview';
    $isMultiple = Str::endsWith($name, '[]');
@endphp
<div class="form-group mb-3">
    <label for="{{ $inputId }}">{{ $label }}</label>
    <input type="file" name="{{ $name }}" id="{{ $inputId }}" 
           data-uploader="true" data-preview="{{ $previewId }}" 
           @if($isMultiple) multiple @endif
           class="form-control @error(str_replace('[]','',$name)) is-invalid @enderror">
    <div id="{{ $previewId }}" class="mt-3">
        @if($existingImages)
            @foreach($existingImages as $image)
                <div class="existing-image" data-id="{{ $image['id'] ?? '' }}">
                    <img src="{{ $image['url'] ?? $image }}" class="img-thumbnail mr-2" style="height:50px;">
                </div>
            @endforeach
        @endif
    </div>
    @error(str_replace('[]','',$name))
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>