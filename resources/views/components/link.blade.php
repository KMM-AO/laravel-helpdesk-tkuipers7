@php
$classes = 'underline text-blue-500 hover:text-blue-800';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
