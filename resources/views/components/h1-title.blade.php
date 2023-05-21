<style>
    .font-heebo {
        font-family: 'Russo One', sans-serif;
    }
</style>

<h1 {{ $attributes->merge(['class' => 'font-heebo font-bold text-2xl md:text-3xl lg:text-4xl text-transparent bg-gradient-to-r bg-clip-text from-blue-500 to-green-500 mb-10 mt-5'])  }}>
    {{ $slot }}
</h1>
