@props([
	'name',
	'id' => null,
	'options' => null,
	'errors' => null,
	'label' => null,
	'selected' => null, // added prop
])
@php
	$id = $id ?? $name;
@endphp
<div class="form-group mb-3">
	@if($label)
		<label for="{{ $id }}">{{ $label }}</label>
	@endif
	<select name="{{ $name }}" id="{{ $id }}" class="form-control @error($name) is-invalid @enderror">
		@foreach($options as $key => $optionLabel)
			<option value="{{ $key }}" {{ (string)$key === (string)old($name, $selected) ? 'selected' : '' }}>
				{{ $optionLabel }}
			</option>
		@endforeach
	</select>
	@error($name)
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>