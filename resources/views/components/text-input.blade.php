@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'focus:border-mint focus:ring-mint rounded-md shadow-sm']) !!}>
