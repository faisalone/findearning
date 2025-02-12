@props([
    'name', 
    'label', 
    'options', 
    'selected' => '', 
    'placeholder' => 'Select Category', 
    'optionLabel' => 'title', 
    'optionValue' => 'id'
])
<div class="form-group mb-3">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" id="{{ $name }}" class="form-select @error($name) is-invalid @enderror">
        <option value="" disabled {{ $selected == '' ? 'selected' : '' }}>{{ $placeholder }}</option>
        @foreach($options as $option)
            @php 
                $optionId = $option[$optionValue] ?? $option->id;
                $optionText = $option[$optionLabel] ?? $option->title;
            @endphp
            <option value="{{ $optionId }}" {{ $selected == $optionId ? 'selected' : '' }}>
                {{ $optionText }}
            </option>
        @endforeach
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
