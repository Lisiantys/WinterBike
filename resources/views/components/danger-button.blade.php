<div class="flex justify-end">
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'h-10 mt-2 font-semibold bg-red-500 text-white px-4 py-2 rounded text-base']) }}>
        {{ $slot }}
    </button>
</div>
