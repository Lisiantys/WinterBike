<div class="p-6 mb-5 bg-white shadow-lg rounded-lg border border-gray-200">
    <div class="md:flex justify-between items-start">
        <a href="{{ route('events.show', $event->id) }}" class="flex-grow">
            @if (!is_null($event->staffMessage) && $event->is_validated === 0 && (auth()->user()->role->id === 3 || auth()->user()->role->id === 4 || $event->user->id === auth()->user()->id))
                <p class="text-red-600"><strong>Message de l'équipe :</strong> {{ $event->staffMessage}}</p>
            @endif
            <h2 class="block mt-1 text-lg md:text-xl leading-tight font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500 hover:underline">{{ Str::limit($event->name , $limit = 55, $end = '...') }}</h2>
            <p class="mt-2 text-gray-600">Du <span class="font-semibold">{{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }}</span> au <span class="font-semibold">{{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }}</span> - <span class="font-semibold">{{ $event->type->name }}</span></p>
            <p class="mt-2 text-gray-600 font-semibold">{{ $event->region->name }} - {{ $event->department->name }}</p>
            @if (!$isTopFavorite == true)
                <p class="mt-2 text-gray-600 overflow-auto break-words">{{ Str::limit($event->description, $limit = 85, $end = '...') }}</p>
            @endif
        </a>

        @if (isset($isFavoriteView) && $isFavoriteView)
            <form method="POST" action="{{ route('favorites.remove', $event->id) }}" class="mt-4 md:mt-0">
                @csrf
                @method('DELETE')
                <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Supprimer</button>
            </form>
        @endif
        
    </div>

    <div class="mt-2 flex items-center justify-between">
        <div class="flex items-center">
            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
            <a href="{{ route('profile.show', $event->user->id ) }}" class="ml-2 text-gray-800 hover:text-blue-600">{{ $event->user->name }}</a>
        </div>
        <div class="text-sm text-gray-500 flex justify-end">
            @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
                <p class="text-yellow-400"><i class="fa-solid fa-star fa-xl">{{ $event->favoritedBy->count() }}</i></p>
            @else
                <p class="text-gray-400"><i class="fa-regular fa-star fa-xl">{{ $event->favoritedBy->count() }}</i></p>
            @endif
        </div>
    </div> 
</div>
