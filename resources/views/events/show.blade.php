<x-app-layout>
    <div class="relative bg-white overflow-hidden shadow-xl sm:rounded-lg grid md:grid-cols-2 mb-6">
        @if ($event->is_validated === 0 && (auth()->user()->role->id === 3 || auth()->user()->role->id === 4 || $event->user->id === auth()->user()->id))
            <div class="absolute top-0 text-center font-semibold inset-x-0 md:inset-auto md:right-0 bg-red-500 text-white px-3 py-2 md:rounded-bl-lg">Événement en cours de validation par l'équipe de Winter Bike...</div>
        @endif
        <div class="md:col-span-2 grid md:grid-cols-2 w-full md:px-6 md:pt-14 md:pb-8 md:gap-6">
            <div class="w-full h-full md:h-96 flex items-center justify-center">
                <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image" class="w-full h-full object-cover rounded-lg">
            </div>
            <div class="px-4 md:px-0 space-y-4 py-6 md:py-0">
                <h2 class="font-heebo font-bold text-xl md:text-2xl lg:text-3xl text-transparent bg-gradient-to-r bg-clip-text from-blue-500 to-green-500">
                    {{ $event->name }}
                </h2>
                <p class="mt-2 text-gray-500">Du <strong>{{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }}</strong> - {{ $event->type->name }}</p>
                <p class="mt-2 text-gray-500">{{ $event->region->name }} - {{ $event->department->name }}</p>
                <p class="text-black-500">{{ $event->description }}</p>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
                        <a href="{{ route('profile.show', $event->user->id) }}" class="ml-2">{{ $event->user->name }}</a>
                    </div>
                
                    @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
                        <p><i class="fa-solid fa-star fa-xl" style="color: #FFD700;">{{ $event->favoritedBy->count() }}</i></p>
                    @else
                        <p><i class="fa-regular fa-star fa-xl" style="color: #e7ca25;">{{ $event->favoritedBy->count() }}</i></p>
                    @endif
                </div>                
            </div>
        </div>
        <x-events.event-link :event="$event"/>
        <div class="px-4 md:px-6 pb-6 space-y-4 col-span-full">
            @auth
                @if(auth()->user()->email_verified_at !== null) 
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
                        @php
                        $isFavorite = auth()->user()->favoritedEvents->contains($event->id);
                        @endphp
                        @if($isFavorite)
                            <form action="{{ route('favorites.remove', $event->id) }}" method="POST" class="col-span-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full h-10 font-semibold bg-red-500 text-white py-2 px-4 rounded text-base">Retirer des favoris</button>
                            </form>
                        @else
                            <form action="{{ route('favorites.add', $event->id) }}" method="POST" class="col-span-1">
                                @csrf
                                <button type="submit" class="w-full h-10 font-semibold bg-green-500 text-white py-2 px-4 rounded text-base">Ajouter aux favoris</button>
                            </form>
                        @endif
                        @if(auth()->user()->role->id === 3 || auth()->user()->role->id === 4)
                            <a href="{{ route('events.edit', $event->id) }}" class="col-span-1 h-10 font-semibold bg-green-500 text-white py-2 px-4 rounded text-base flex items-center justify-center">Modifier l'événement</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="col-span-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full h-10 font-semibold bg-red-500 text-white py-2 px-4 rounded text-base" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">Supprimer l'événement</button>
                            </form>
                        @endif
                    </div>
                @endif
            @endauth
        </div>
    </div>

    @auth
    @if(auth()->user()->email_verified_at !== null)
    <div class="flex md:flex-row items-center md:space-x-4 mb-6">
        <h2 class="text-xl md:text-2xl font-semibold text-gray-900 dark:text-white mb-2 md:mb-0">Commentaires ({{ $comments->count() }})</h2>
        <div class="flex items-center">
            <div class="flex items-center ml-4 space-x-2 a2a_kit a2a_kit_size_32 a2a_default_style">
                <a class="a2a_button_facebook"></a>
                <a class="a2a_button_twitter"></a>
                <a class="a2a_button_skype"></a>
            </div>
            <a href="#" id="copyLink" class="text-gray-600 hover:text-gray-800 transition duration-200">
                <i class="fa-solid fa-share-nodes fa-lg"></i>
            </a>
        </div>
    </div>
    <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mb-6 space-y-4">
        @csrf
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg">
            <textarea id="description" name="description" rows="4" class="px-3 py-2 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded-lg resize-none" placeholder="Écrire un commentaire..." required></textarea>
        </div>
        <button type="submit" class="h-10 w-full md:w-auto py-2 px-6 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white rounded-lg transition duration-200 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-white">
            Commenter
        </button>
    </form>
    @else
    <h3 class="text-gray-800 dark:text-white">Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
    @endif
    @endauth

    @guest
    <h3 class="text-gray-800 dark:text-white">Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
    @endguest

    <div class="flex flex-col lg:flex-row lg:space-x-6">
        <div class="lg:w-1/2">
            @forelse($comments as $comment)
                <div class="bg-white dark:bg-gray-900 rounded-lg shadow-lg mb-4">
                    <div class="p-4 divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center space-x-4">
                                <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">
                                        <a href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                                    </h4>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</span>
                                </div>
                            </div>
                            @auth
                                @if(auth()->user()->id === $comment->user_id || auth()->user()->role_id === 4 || auth()->user()->role_id === 3)
                                    <div>
                                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');" class="text-red-600 hover:text-red-500 transition duration-150">Supprimer</button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                        <div class="pt-2">
                            <p class="text-sm text-gray-600 dark:text-gray-300">{{ $comment->description }}</p>
                        </div>
                    </div>
                </div>
            @empty
                @auth
                    <p class="text-gray-500 dark:text-gray-400">Soyez le premier à commenter cet évènement !</p>
                @endauth
            @endforelse
            <div>{{ $comments->links() }}</div>
        </div>
    
        <div class="mt-8 lg:mt-0 lg:w-1/2">
            @foreach ($topFavorites as $favorite)
                <x-events.event-list :event="$favorite"/>
            @endforeach 
        </div>
    </div>
    
    <script>
        document.getElementById('copyLink').addEventListener('click', function(event) {
            event.preventDefault();
            // Créer un élément temporaire pour contenir le lien de la page
            var tempInput = document.createElement('input');
            tempInput.value = window.location.href;
            // Ajouter l'élément temporaire à la page
            document.body.appendChild(tempInput);
            // Sélectionner le contenu de l'élément temporaire
            tempInput.select();
            // Copier le contenu sélectionné dans le presse-papiers
            document.execCommand('copy');
            // Supprimer l'élément temporaire
            document.body.removeChild(tempInput);
            // Afficher un message ou effectuer une autre action pour indiquer que le lien a été copié
            alert('Le lien a été copié dans le presse-papiers !');
        });
    </script>

    <script>
        var a2a_config = a2a_config || {};
        a2a_config.locale = "fr";
        a2a_config.num_services = 4;
    </script>
    <script async src="https://static.addtoany.com/menu/page.js"></script>
</x-app-layout>