@props(['href' => '#', 'type' => ''])

@if($type === 'submit')
    <button type="submit" 
        class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" 
        class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">
        {{ $slot }}
    </a>
@endif
