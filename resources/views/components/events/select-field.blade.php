<div>
    <label for="{{ $name }}" class="block text-lg font-bold">{{ $label }} :</label>
    <select id="{{ $name }}" name="{{ $name }}" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-mint focus:border-transparent" {{ $attributes }}>
        {{ $slot }}
    </select>
</div>
