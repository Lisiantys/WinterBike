<div>
    <label for="{{ $name }}" class="block text-lg font-bold">{{ $label }} :</label>
    <input type="{{ $type }}" id="{{ $name }}" value="{{ old($name) }}" name="{{ $name }}" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" {{ $attributes }}>
    @error($name)
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
