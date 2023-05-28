<div class="flex col-span-full md:px-6 md:grid md:grid-cols-2 lg:grid-cols-3 gap-4 justify-center items-center md:items-start">
    @isset($event->phone)
        <a class="flex items-center" href="tel:{{ $event->phone }}">
            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 flex-grow-0 rounded-full bg-gradient-to-r from-blue-500 to-green-500">
                <i class="fa-solid fa-phone fa-xl" style="color: #ffffff;"></i>
            </div>
            <p class="ml-2 hidden md:block">{{ $event->phone }}</p>
        </a>
    @endisset

    @isset($event->email)
        <a class="flex items-center" href="mailto:{{ $event->email }}">
            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 flex-grow-0 rounded-full bg-gradient-to-r from-blue-500 to-green-500">
                <i class="fa-solid fa-envelope fa-xl" style="color: #ffffff;"></i>
            </div>
            <p class="ml-2 hidden md:block">{{ $event->email }}</p>
        </a>
    @endisset

    @isset($event->address)
        <a class="flex items-center" href="https://www.google.com/maps/search/{{ urlencode($event->address) }}" target="_blank">
            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 flex-grow-0 rounded-full bg-gradient-to-r from-blue-500 to-green-500">
                <i class="fa-solid fa-map-location-dot fa-xl" style="color: #ffffff;"></i>
            </div>
            <p class="ml-2 hidden md:block">{{ $event->address }}</p>
        </a>
    @endisset

    @isset($event->website)
        <a class="flex items-center" href="{{ $event->website }}" target="_blank">
            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 flex-grow-0 rounded-full bg-gradient-to-r from-blue-500 to-green-500">
                <i class="fa-solid fa-arrow-pointer fa-xl" style="color: #ffffff;"></i>
            </div>
            <p class="ml-2 hidden md:block">{{ $event->website }}</p>
        </a>
    @endisset

    @isset($event->facebook)
        <a class="flex items-center" href="{{ $event->facebook }}" target="_blank">
            <div class="flex items-center justify-center w-12 h-12 flex-shrink-0 flex-grow-0 rounded-full bg-gradient-to-r from-blue-500 to-green-500">
                <i class="fa-brands fa-facebook-f fa-xl" style="color: #ffffff;"></i>
            </div>
            <p class="ml-2 hidden md:block">{{ $event->facebook }}</p>
        </a>
    @endisset
</div>
