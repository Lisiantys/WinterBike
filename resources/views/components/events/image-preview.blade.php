@props(['id', 'src', 'alt'])

<div class="w-full md:w-1/2">
    <img id="{{ $id }}" src="{{ $src }}" alt="{{ $alt }}" class="w-full flex-grow h-auto sm:h-96 rounded-lg">
</div>
