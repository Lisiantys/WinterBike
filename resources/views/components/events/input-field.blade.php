@props(['id', 'name', 'type' => 'text', 'label', 'value' => '', 'required' => false, 'maxlength' => false])

<div>
    <label for="{{ $name }}" class="block text-lg font-bold">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" value="{{ old($name, $value) }}" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
    {{ $required ? 'required' : '' }} 
    {{ $maxlength ? 'maxlength='.$maxlength : '' }}
    {{ $attributes }}>
    
    @error($name)
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
