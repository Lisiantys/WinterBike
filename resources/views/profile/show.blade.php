<x-app-layout>
    {{-- Section informations profile --}}
    <section class="w-full h-full mt-20 lg:mt-0">
        <div class="flex flex-col">
            <div
                class="w-full flex items-center justify-start bg-gradient-to-bl from-dark-green to-mint text-white p-6 rounded-t-lg shadow-md">
                <img src="{{ asset('storage/' . $user->image_path) }}" alt="Image de l'utilisateur"
                    class="rounded-full w-20 h-20 sm:w-32 sm:h-32 object-cover border-2 border-white">
                <div class="ml-5">
                    <h1 class="font-semibold text-lg md:text-2xl sm:text-3xl">{{ $user->name }}</h1>
                    <p class="text-sm sm:text-base text-white mb-2">{{ $user->role->name }}</p>
                    <p class="text-sm sm:text-base text-white">
                        Inscription le :{{ \Carbon\Carbon::parse($user->created_at)->isoFormat('LL') }}
                    </p>
                </div>
            </div>

            <div
                class="text-black flex flex-col sm:flex-row items-center justify-between sm:px-6 space-y-3 py-2 rounded-b-lg bg-greyed border-t-2 border-blue-300">
                <div class="mt-2 sm:mt-0 sm:w-60">
                    @auth
                        @if (auth()->user()->id === $user->id)
                            <x-events.button-gradient href="{{ route('profile.edit') }}">
                                Modifier le profil
                            </x-events.button-gradient>
                        @endif
                    @endauth
                </div>
                <div class="flex w-full justify-evenly sm:justify-end text-center items-center py-1 sm:space-x-6">
                    <div>
                        <p class="mb-1 font-semibold text-lg">{{ $eventsCount }}</p>
                        <p class="text-sm sm:text-base text-gray-500 mb-0">Événements</p>
                    </div>
                    <div>
                        <p class="mb-1 font-semibold text-lg">{{ $favoritesCount }}</p>
                        <p class="text-sm sm:text-base text-gray-500 mb-0">Favoris</p>
                    </div>
                    <div>
                        <p class="mb-1 font-semibold text-lg">{{ $commentsCount }}</p>
                        <p class="text-sm sm:text-base text-gray-500 mb-0">Commentaires</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Section événements --}}
    <div class="mt-8 p-4">
        <div>
            <h2 class="text-lg md:text-2xl mb-4 py-4 px-6 bg-mint rounded-lg font-semibold text-white">
                Événements créés par l'utilisateur</h2>
            @forelse($events as $event)
                <div class="mb-4 rounded-lg">
                    <x-events.event-list :event="$event" />
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

        {{-- Section commentaires --}}
        <div>
            <h2 class="text-lg md:text-2xl mb-4 py-4 px-6 bg-mint rounded-lg font-semibold text-white">
                Commentaires de l'utilisateur
            </h2>
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
    </div>
</x-app-layout>
