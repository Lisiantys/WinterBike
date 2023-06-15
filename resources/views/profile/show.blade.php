<x-app-layout>
    <section class="w-full h-full">
        <div class="flex flex-col">
            <div class="w-full flex items-center justify-start bg-gradient-to-r from-blue-500 to-green-500 text-white p-6 rounded-t-lg shadow-md">
                <img src="{{ Storage::url($user->image_path) }}"
                    alt="Image de l'utilisateur" class="rounded-full w-32 h-32 object-cover border-2 border-blue-300"
                >  
                <div class="ml-5">
                    <h1 class="font-semibold text-3xl">{{ $user->name }}</h1>
                    <p class="text-base text-white mb-2">{{ $user->role->name }}</p>
                    <p class="text-base text-white">Inscription le : {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}</p>
                </div>
            </div>
            
            
            <div class="text-black flex items-center justify-between px-6 py-2 rounded-b-lg bg-white border-t-2 border-blue-300">
                @auth
                    @if(auth()->user()->id === $user->id)
                        <a href="{{ route('profile.edit') }}" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Modifier le profil</a>
                    @endif
                @endauth
                <div class="flex justify-end text-center py-1">
                    <div>
                        <p class="mb-1 font-semibold text-lg">{{ $favoritesCount }}</p>
                        <p class="text-base text-gray-500 mb-0">Favoris</p>
                    </div>
                    <div class="px-6">
                        <p class="mb-1 font-semibold text-lg">{{ $eventsCount }}</p>
                        <p class="text-base text-gray-500 mb-0">Événements</p>
                    </div>
                    <div>
                        <p class="mb-1 font-semibold text-lg">{{ $commentsCount }}</p>
                        <p class="text-base text-gray-500 mb-0">Commentaires</p>
                    </div>
                </div>
            </div>
            
            </div>
        </div>
    </section>
     
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
