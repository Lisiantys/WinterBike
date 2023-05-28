<x-app-layout>

    <div class="flex flex-col md:flex-row items-center justify-center md:justify-between">
        <div class="flex flex-col items-center md:flex-row md:items-start text-center md:text-left">
            <img src="{{ Storage::url($user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-24 h-24">
            <div class="md:ml-4 mt-2">
                <h1 class=" font-bold text-2xl">{{ $user->name }}</h1>
                <p class="text-sm text-gray-500">{{ $user->role->name }}</p>
                <p class="text-sm text-gray-500">Inscription le : {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</p>
            </div>
        </div>
        @auth
            @if(auth()->user()->id === $user->id)
                <a href="{{ route('profile.edit') }}" class="mt-4 md:mt-0 h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier le profil</a>
            @endif
        @endauth
    </div>
    
    
    <h2 class="font-bold text-2xl mt-8 mb-4">Événements créés par l'utilisateur</h2>
    @forelse($events as $event)
        <div class="mb-4">
            <x-events.event-list :event="$event"/>
            <!-- Afficher plus d'informations sur l'événement si vous le souhaitez -->
        </div>
    @empty
        <x-events.empty-message>
            Aucun événement crée par l'utilisateur.
        </x-events.empty-message>
    @endforelse
    <div>{{ $events->links() }}</div>


    <h2 class="font-bold text-2xl mt-8 mb-4">Commentaires de l'utilisateur</h2>
    @forelse($comments as $comment)
    <div class="bg-white rounded-lg p-4 mb-4">
        <div class="flex items-center mb-2">
            <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-8 h-8">
            <p class="ml-2"><strong>{{ $comment->user->name }}</strong> a posté un commentaire sur <strong><a href="{{ route('events.show', $comment->event->id) }}" class="text-blue-500">{{ $comment->event->name }}</a></strong></p>
        </div>
        <p class="text-sm text-gray-500">Le : {{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</p>

        <p class="mt-2">{{ $comment->description }}</p>

        @auth
            @if(auth()->user()->id === $comment->user_id || auth()->user()->role_id === 4 || auth()->user()->role_id === 3)
                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Supprimer</button>
                </form>
            @endif
        @endauth
    </div>
    @empty
        <x-events.empty-message>
            Aucun commentaire publié l'utilisateur.
        </x-events.empty-message>
    @endforelse
    <div>{{ $comments->links() }}</div>
</x-app-layout>
