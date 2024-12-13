@props(['value'])

<label {{ $attributes->merge(['class' => 'bold']) }}>
    {{ $value ?? $slot }}
</label>
