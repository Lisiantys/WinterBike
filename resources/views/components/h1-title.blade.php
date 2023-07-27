<style>
    .font-open-sans {
        font-family: 'Open Sans', sans-serif;
        text-shadow: 2px 2px #000;
    }
    .xl-size{
        font-size: clamp(30px, 2.8vw, 65px);
    }
</style>

<h1 {{ $attributes->merge(['class' => 'text-white font-open-sans xl-size bg-gradient-to-t from-dark-green to-mint w-full px-6 pt-16 mt-20 h-36 lg:mt-0 '])  }}>
    {{ $slot }}
</h1>
<div class="w-full h-16" style="background: linear-gradient(178deg, #10564f 50%, white 50%);"></div>

