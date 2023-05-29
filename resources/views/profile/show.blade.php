<x-app-layout>
    <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between py-6 space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="flex items-center space-x-4">
            <img src="{{ Storage::url($user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-24 h-24">
            <div>
                <h1 class="font-semibold text-3xl">{{ $user->name }}</h1>
                <p class="text-sm text-gray-500">{{ $user->role->name }}</p>
                <p class="text-sm text-gray-500">Inscription le : {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</p>
            </div>
        </div>
        @auth
            @if(auth()->user()->id === $user->id)
                <a href="{{ route('profile.edit') }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier le profil</a>
            @endif
        @endauth
    </div>
    
    <div class="mt-8">
        <h2 class="font-bold text-2xl mb-4">Événements créés par l'utilisateur</h2>
        @forelse($events as $event)
            <div class="mb-4  rounded-lg ">
                <x-events.event-list :event="$event"/>
            </div>
        @empty
            <div class="bg-white shadow rounded-lg p-4">
                <x-events.empty-message>
                    Aucun événement crée par l'utilisateur.
                </x-events.empty-message>
            </div>
        @endforelse
        <div>{{ $events->links() }}</div>
    </div>

    <div class="mt-8">
        <h2 class="font-bold text-2xl mb-4">Commentaires de l'utilisateur</h2>
        @forelse($comments as $comment)
        <div class="bg-white rounded-lg shadow p-4 mb-4">
            <div class="flex items-center mb-2">
                <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-8 h-8">                    
                <p class="ml-2"><strong>{{ $comment->user->name }}</strong> a posté un commentaire sur <strong><a href="{{ route('events.show', $comment->event->id) }}" class="text-base font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">{{ $comment->event->name }}</a></strong></p>
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
            <div class="bg-white shadow rounded-lg p-4">
                <x-events.empty-message>
                    Aucun commentaire publié l'utilisateur.
                </x-events.empty-message>
            </div>
        @endforelse
        <div>{{ $comments->links() }}</div>
    </div>
</x-app-layout>
