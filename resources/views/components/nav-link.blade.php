@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex w-full items-center p-2 border-l-4 rounded border-mint bg-greyed md:text-lg font-medium text-black transition duration-500 ease-in-out'
            : 'inline-flex w-full items-center p-2 hover:border-l-4 hover:rounded hover:border-mint hover:bg-greyed md:text-lg font-medium text-gray-600 hover:text-mint hover:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
