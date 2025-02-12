@extends('dashboard.layouts.app')

@section('content')
@php
    $allAttributes = collect();
    // Collect each unique (id, label) pair for display
    foreach ($product->variants as $variant) {
        foreach ($variant->attributes as $attr) {
            $title = $attr->attribute->title;
            $valueId = $attr->attribute_value_id;
            $valueLabel = optional($attr->attributeValue)->value ?? $valueId; // fallback to ID

            $set = $allAttributes->get($title, collect());
            // Avoid duplicates by ID
            if (!$set->contains('id', $valueId)) {
                $set->push(['id' => $valueId, 'label' => $valueLabel]);
            }
            $allAttributes->put($title, $set);
        }
    }
@endphp

<div id="combination-wrapper">
    @foreach($allAttributes as $title => $valueObjs)
        <h4>{{ $title }}</h4>
        @foreach($valueObjs as $val)
            <label>
                <input type="radio" name="{{ $title }}_options" value="{{ $val['id'] }}">
                {{ $val['label'] }}
            </label>
        @endforeach
    @endforeach

    <div style="margin-top:20px;">
        <strong>Price_Factor: </strong><span id="priceFactor"></span><br>
        <strong>Quantity_Factor: </strong><span id="quantityFactor"></span>
    </div>
</div>

<script>
    // Prepare all variants data with attribute-value IDs
    const variants = @json($product->variants->map(function($v){
        return [
            'price_factor' => $v->price_factor,
            'quantity_factor' => $v->quantity_factor,
            'attributes' => $v->attributes->mapWithKeys(function($a){
                return [$a->attribute->title => $a->attribute_value_id];
            })
        ];
    }));

    function updateFactors() {
        let selected = {};
        document.querySelectorAll('#combination-wrapper input[type="radio"]:checked')
            .forEach(r => {
                selected[r.name.replace('_options', '')] = parseInt(r.value, 10);
            });

        // New matching: for every selected key, if the variant has that attribute then require a match.
        let found = variants.find(v =>
            Object.keys(selected).every(key => 
                !v.attributes.hasOwnProperty(key) || v.attributes[key] == selected[key]
            )
        );

        document.getElementById('priceFactor').textContent = found ? found.price_factor : '';
        document.getElementById('quantityFactor').textContent = found ? found.quantity_factor : '';
    }

    document.querySelectorAll('#combination-wrapper input[type="radio"]').forEach(el => {
        el.addEventListener('change', updateFactors);
    });

    // Automatically select the first radio option from each group on page load
    document.addEventListener('DOMContentLoaded', () => {
        let groups = {};
        document.querySelectorAll('#combination-wrapper input[type="radio"]').forEach(radio => {
            if (!groups[radio.name]) {
                groups[radio.name] = radio;
            }
        });
        Object.values(groups).forEach(radio => {
            radio.checked = true;
        });
        updateFactors();
    });
</script>
@endsection
