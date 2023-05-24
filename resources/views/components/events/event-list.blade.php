<div class="p-4 mb-5 border-4 border-s-blue-900 border-y-blue-700 border-r-blue-500">
    <div class="md:flex justify-between items-start">
        <a href="{{ route('events.show', $event->id) }}" class="flex-grow">
            @if (!is_null($event->staffMessage) && $event->is_validated === 0 && $event->user->id === auth()->user()->id)
                <p class="text-red-600"><strong>Message de l'équipe :</strong> {{ $event->staffMessage}}</p>
            @endif
            <h1 class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">{{ $event->name }}</h1>
            <p class="mt-2 text-gray-500">Du {{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }} - {{ $event->type->name }}</p>
            <p class="mt-2 text-gray-500">{{ $event->region->name }} - {{ $event->department->name }}</p>
            <p class="mt-2 text-gray-500">{{ Str::limit($event->description, $limit = 85, $end = '...') }}</p>
        </a>

        @if (isset($isFavoriteView) && $isFavoriteView)
            <form method="POST" action="{{ route('favorites.remove', $event->id) }}" class="mt-4 md:mt-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Retirer l'évènement des favoris</button>
            </form>
        @endif
    </div>

    <div class="mt-4 flex justify-between items-center">
        <div class="flex items-center">
            <img class="h-10 w-10 rounded-full" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
            <a href="{{ route('profile.show', $event->user->id ) }}" class="ml-2">{{ $event->user->name }}</a>
        </div>
        <div class="text-sm text-gray-500">
            @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
                <p class="text-yellow-400"><i class="fa-solid fa-star fa-xl">{{ $event->favoritedBy->count() }}</i></p>
            @else
                <p class="text-gray-400"><i class="fa-regular fa-star fa-xl">{{ $event->favoritedBy->count() }}</i></p>
            @endif
        </div>
    </div>
</div>
