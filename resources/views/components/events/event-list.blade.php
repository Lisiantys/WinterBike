<div {{ $attributes->merge(['class' => 'max-w-lg mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl']) }}>
    <div class="md:flex">
        <div class="md:flex-shrink-0">
            <img class="h-48 w-full object-cover md:w-48" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
        </div>
        <div class="p-8">
            <h1 class="block mt-1 text-lg leading-tight font-medium text-black hover:underline"><a href="{{ route('events.show', $event->id) }}">{{ $event->name }}</a></h1>
            <p class="mt-2 text-gray-500">Du {{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }} - {{ $event->type->name }}</p>
            <p class="mt-2 text-gray-500">{{ $event->region->name }} - {{ $event->department->name }}</p>
            <p class="mt-2 text-gray-500">{{ Str::limit($event->description, $limit = 100, $end = '...') }}</p>
            <div class="mt-2 flex items-center text-sm text-gray-500">
                @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
                    <p class="text-yellow-400"><i class="fa-solid fa-star">{{ $event->favoritedBy->count() }}</i></p>
                @else
                    <p class="text-gray-400"><i class="fa-regular fa-star">{{ $event->favoritedBy->count() }}</i></p>
                @endif
            </div>
        </div>
    </div>
</div>
