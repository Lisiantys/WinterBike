@props(['id', 'src', 'alt'])

<div class="flex flex-col items-center space-y-4">
    <img id="{{ $id }}" src="{{ $src }}" alt="{{ $alt }}" class="mx-auto h-auto sm:h-96 rounded-lg">
</div>
