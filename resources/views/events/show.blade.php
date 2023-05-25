<x-app-layout>
    <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image" style="max-width: 100%;">
    <x-h1-title>
        {{ $event->name }}
    </x-h1-title>
    <div class="flex justify-between items-center">
        <p class="text-gray-500">Du <strong>{{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }}</strong> - {{ $event->type->name }}</p>
        @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
            <p><i class="fa-solid fa-star fa-xl" style="color: #FFD700;">{{ $event->favoritedBy->count() }}</i></p>
        @else
            <p><i class="fa-regular fa-star fa-xl" style="color: #e7ca25;">{{ $event->favoritedBy->count() }}</i></p>
        @endif
    </div>
    <p class="mt-2 text-gray-500">{{ $event->region->name }} - {{ $event->department->name }}</p>
    <p>{{ $event->description }}</p>
    <div class="flex items-center">
        <img class="h-10 w-10 rounded-full" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
        <a href="{{ route('profile.show', $event->user->id) }}" class="ml-2">{{ $event->user->name }}</a>
    </div>
    <div class="flex items-center">
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_skype"></a>
        </div>
        <a href="#" id="copyLink"><i class="fa-solid fa-share-nodes fa-xl" style="color: #808080;"></i></a>
    </div>
    <div class="flex items-center justify-end">
        @auth
            @if(auth()->user()->email_verified_at !== null) 
                @php
                $isFavorite = auth()->user()->favoritedEvents->contains($event->id);
                @endphp

                @if($isFavorite)
                    <form action="{{ route('favorites.remove', $event->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Retirer des favoris</button>
                    </form>
                @else
                    <form action="{{ route('favorites.add', $event->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Ajouter au favoris</button>
                    </form>
                @endif
            @endif
        @endauth

        @auth
            @if(auth()->user()->id === $event->user_id || auth()->user()->role_id === 4) {{-- ok --}}
            <div class="h-10 my-2 w-52 rounded-md bg-gradient-to-r from-blue-500 to-green-500 p-1">
                <div class="flex h-full  items-center justify-center bg-white">
                    <a href="{{ route('events.edit', $event->id) }}" class="text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">Modifier l'événement</a>
                </div>
            </div>
                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-red-500 to-orange-500 text-white py-2 px-4 rounded text-base" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');">Supprimer l'événement</button>
                </form>
            @endif
        @endauth
    </div>

    @auth
        @if(auth()->user()->email_verified_at !== null)  {{-- ok --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Commentaires ({{ $comments->count() }})</h2>
        </div>
        <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mb-6">
            @csrf
              <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                  <textarea id="description" name="description" rows="6"  
                      class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                      placeholder="Écrire un commentaire..." required></textarea>
              </div>
              <button type="submit"
              class="h-10 mt-2 mb-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">
                  Commenter
              </button>
          </form>
        @else
            <h3>Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
        @endif
    @endauth

    @guest
        <h3>Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
    @endguest

    <div class="flex flex-col lg:flex-row">
        <div class="lg:w-1/2">
            @forelse($comments as $comment)
                <div class=" flex flex-col w-full lg:pr-4 py-4 mx-auto divide-y rounded-md divide-gray-700 dark:bg-gray-900 dark:text-gray-100">
                    <div class="flex justify-between">
                        <div class="flex space-x-4">
                            <div>
                                <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image" class="object-cover w-12 h-12 rounded-full dark:bg-gray-500">
                            </div>
                            <div>
                                <h4 class="font-bold"><a  href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->name }}</a></h4>
                                <span class="text-xs dark:text-gray-400">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2 dark:text-yellow-500">
                            @auth
                                @if(auth()->user()->id === $comment->user_id || auth()->user()->role_id === 4 || auth()->user()->role_id === 3)
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?');" class="text-red-600">Supprimer</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                    <div class="p-4 space-y-2 text-sm dark:text-gray-400">
                        <p>{{ $comment->description }}</p>
                    </div>
                </div>
            @empty
            <p>Soyez le premier à commenter cet évènement !</p>
            @endforelse
        </div>

        <div class="mt-6 lg:mt-0 lg:w-1/2 lg:pl-6">
            @foreach ($topFavorites as $favorite)
                <x-events.event-list :event="$favorite"/>
            @endforeach 
        </div>
    </div>
    
    <div>{{ $comments->links() }}</div>
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