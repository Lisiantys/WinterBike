@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block mt-1 w-full border border-mint focus:border-mint focus:ring-mint rounded-md shadow-sm']) !!}>
