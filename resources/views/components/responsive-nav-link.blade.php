@props(['active'])

<a {{ $attributes->merge(['class' => 'button']) }}>
    {{ $slot }}
</a>
