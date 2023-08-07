@props([
    'type' => 'text',
    'name',
    'value' => '',
    'label' => false
])

@if ($label)
    <label for="{{ $name }}">{{ $label }}</label>
@endif

@if ($type === 'date')
    @php
   
        $dateValue = $value instanceof \DateTime ? $value->format('Y-m-d') : ($value ?: '');
    @endphp

    <input
        type="date"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ $dateValue }}"
        {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($name)
        ]) }}>
@else
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="Enter {{ $name }}"
        {{ $attributes->class([
            'form-control',
            'is-invalid' => $errors->has($name)
        ]) }}>
@endif

@error($name)
    <div class="alert alert-danger">{{ $message }}</div>
@enderror
