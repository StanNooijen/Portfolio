@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-100 rounded-sm border-none']) }}>
