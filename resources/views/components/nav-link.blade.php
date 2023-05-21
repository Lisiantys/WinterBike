@props(['active'])

@php
$classes = ($active ?? false)
            ? 'mb-3 inline-flex items-center px-1 pt-1 border-indigo-400 text-lg font-medium leading-5 text-black-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'mb-3 inline-flex items-center px-1 pt-1 border-transparent text-lg font-medium leading-5 text-black-500 hover:text-gray-600 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
