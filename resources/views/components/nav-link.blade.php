@props(['active'])

@php
$classes = ($active ?? false)
            ? 'background-color: transparent;'
            : 'background-color: var(--nav-link-active-bg);';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
