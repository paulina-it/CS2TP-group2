@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-black dark:border-black text-sm font-medium leading-5 text-gray-300 dark:text-gray-100 focus:outline-none focus:border-black transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 hover:border-gray-950 dark:hover:border-gray-950 focus:outline-none focus:text-gray-950 dark:focus:text-gray-950 focus:border-gray-950 dark:focus:border-gray-950 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
