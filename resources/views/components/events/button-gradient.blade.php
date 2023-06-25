@props(['href' => '#', 'type' => ''])

@if($type === 'submit')
    <button {{ $attributes->merge(['class' => 'h-10 font-semibold bg-gradient-to-r from-mint to-dark-green text-white py-2 px-4 rounded text-base']) }} type="submit">
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" 
       {{ $attributes->merge(['class' => 'h-10 font-semibold bg-gradient-to-r from-mint to-dark-green text-white py-2 px-4 rounded text-base']) }}>
        {{ $slot }}
    </a>
@endif
