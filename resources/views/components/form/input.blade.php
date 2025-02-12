@props(['name', 'label', 'value' => null])
<div class="form-group mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="text" name="{{ $name }}" id="{{ $name }}" value="{{ $value ?? old($name) }}"
           class="form-control @error($name) is-invalid @enderror">
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
