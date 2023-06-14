<x-app-layout>
    <div class="flex flex-col sm:flex-row items-center justify-center sm:justify-between py-6 space-y-4 sm:space-y-0 sm:space-x-4">
        <div class="flex items-center space-x-4">
            <img src="{{ Storage::url($user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-24 h-24 object-cover">
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
        <div>{{ $events->links('vendor.pagination.custom') }}</div>
    </div>

    <div class="mt-8">
        <h2 class="font-bold text-2xl mb-4">Commentaires de l'utilisateur</h2>


        @forelse($comments as $comment)
            <x-events.event-comment :comment="$comment" :isProfilComment="true" />
        @empty
            <div class="bg-white shadow rounded-lg p-4">
                <x-events.empty-message>
                    Aucun commentaire publié l'utilisateur.
                </x-events.empty-message>
            </div>
        @endforelse
        <div>{{ $comments->links('vendor.pagination.custom') }}</div>
    </div>
</x-app-layout>
