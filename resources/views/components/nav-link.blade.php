@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 md:text-lg font-medium  text-black-900 hover:text-gray-600  focus:outline-none transition duration-500 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 md:text-lg font-medium  text-black-900 hover:text-gray-600 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
