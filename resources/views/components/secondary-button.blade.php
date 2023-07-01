<button {{ $attributes->merge(['type' => 'button', 'class' => 'h-10 mt-2 font-semibold bg-gradient-to-r from-mint to-dark-green text-white px-4 py-2 rounded text-base']) }}>
    {{ $slot }}
</button>
