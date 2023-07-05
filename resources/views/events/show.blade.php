<x-app-layout>
    <div id="overlay" class="fixed top-0 left-0 w-full h-full z-50 bg-black bg-opacity-50 hidden"></div>

    <div class="relative bg-white overflow-hidden shadow-xl sm:rounded-lg grid md:grid-cols-2 mb-6">
        @if ($event->is_validated === 0 && (auth()->user()->role->id === 3 || auth()->user()->role->id === 4 || $event->user->id === auth()->user()->id))
            <div class="absolute top-0 text-center font-semibold inset-x-0 md:inset-auto md:right-0 bg-red-500 text-white px-3 py-2 md:rounded-bl-lg">Événement en cours de validation par l'équipe de Winter Bike...</div>
        @endif
        <div class="md:col-span-2 grid md:grid-cols-2 w-full md:px-6 md:py-10 md:gap-6 rounded-lg bg-greyed">
            <div class="w-full h-full md:h-96 flex items-center justify-center cursor-pointer" onclick="openModal()">
                <img id="image-preview" src="{{ Storage::url($event->image_path) }}" alt="Aperçu de l'image" class="w-full h-full object-cover rounded-lg">
            </div>
            
            <div id="myModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-2 overflow-x-hidden overflow-y-auto md:inset-0 h-[100vh] max-h-full items-center justify-center xl:mx-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 w-full max-w-4xl 2xl:max-w-5xl max-h-full mx-auto overflow-y-auto">
                    <!-- Modal content -->
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="font-heebo font-bold text-lg md:text-xl lg:text-2xl text-transparent bg-gradient-to-r bg-clip-text from-dark-green to-mint">
                            {{ $event->name }}
                        </h3>
                        <button id="closeModal" type="button" class=" p-1.5 dark:hover:bg-gray-600 dark:hover:text-white">
                            <i class="fa-solid fa-xmark fa-2xl text-red-500 hover:text-red-700" ></i>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-2 space-y-6">
                        <img id="modal-image" src="{{ Storage::url($event->image_path) }}" class="object-contain w-full h-auto max-h-50vh rounded-lg">
                    </div>
                </div>
            </div>
            
            <div class="px-4 md:px-0 space-y-4 py-6 md:py-0">
                <h2 class="font-heebo font-bold text-xl md:text-2xl lg:text-3xl text-transparent bg-gradient-to-r bg-clip-text from-dark-green to-mint">
                    {{ $event->name }}
                </h2>
                <p class="mt-2 text-gray-800">Du <strong>{{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }}</strong> au <strong>{{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }}</strong> - {{ $event->type->name }}</p>
                <p class="mt-2 text-gray-800">{{ $event->region->name }} - {{ $event->department->name }}</p>
                <p class="text-black font-semibold">{{ $event->description }}</p>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($event->user->image_path) }}" alt="Image de l'utilisateur">
                        <a href="{{ route('profile.show', $event->user->id) }}" class="ml-2">{{ $event->user->name }}</a>
                    </div>
                
                    @if (auth()->user() && $event->favoritedBy->contains(auth()->user()->id))
                        <p><i class="fa-solid fa-star fa-xl" style="color: #10564f;">{{ $event->favoritedBy->count() }}</i></p>
                    @else
                        <p><i class="fa-regular fa-star fa-xl" style="color: #047076;">{{ $event->favoritedBy->count() }}</i></p>
                    @endif
                </div>                
            </div>
        </div>
        <x-events.event-link :event="$event"/>
        <div class="px-4 md:px-6 pb-6 space-y-4 col-span-full">
            @auth
                @if(auth()->user()->email_verified_at !== null) 
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                                <button type="submit" class="w-full h-10 font-semibold bg-dark-green text-white py-2 px-4 rounded text-base">Ajouter aux favoris</button>
                            </form>
                        @endif
                        @if(auth()->user()->role->id === 3 || auth()->user()->role->id === 4)
                            <a href="{{ route('events.edit', $event->id) }}" class="col-span-1 h-10 font-semibold bg-mint text-white py-2 px-4 rounded text-base flex items-center justify-center">Modifier l'événement</a>
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

    <div class="flex justify-center">
        <div class="w-full lg:w-2/3 mx-auto my-10">
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
                                <i class="fa-solid fa-share-nodes fa-xl"></i>
                            </a>
                        </div>
                    </div>
                    <form action="{{ route('comments.store', $event->id) }}" method="POST" class="mb-6 space-y-4">
                        @csrf
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-mint">
                            <textarea id="description" name="description" rows="6" class="px-3 py-2 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded-lg resize-none" placeholder="Écrire un commentaire..." required minlength="3" maxlength="999">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="text-red-500 mt-2 text-sm">
                                {{ $message }}
                            </div>
                        @enderror
                        <x-events.button-gradient type="submit">Commenter</x-events.button-gradient>
                    </form>
                @else
                    <h3 class="text-gray-800 dark:text-white">Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
                @endif
            @endauth

            @guest
            <h3 class="text-gray-800 dark:text-white">Veuillez-vous connecter et vérifier votre compte pour publier un commentaire.</h3>
            @endguest

            
            @forelse($comments as $comment)
                <x-events.event-comment :comment="$comment" />
            @empty
                @auth
                    <p class="text-gray-500 dark:text-gray-400">Soyez le premier à commenter cet événement !</p>
                @endauth
            @endforelse
            <div>{{ $comments->links('vendor.pagination.custom') }}</div>
        
        </div>
    </div>

    <div class="w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 ">
        @foreach($topFavorites as $eventFavorite)
            <x-events.event-favorites :event="$eventFavorite" :rank="$loop->iteration" />
        @endforeach
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
            alert('Le lien de l\'événement a été copié dans le presse-papiers !');
        });
    </script>

    <script>
        var a2a_config = a2a_config || {};
        a2a_config.locale = "fr";
        a2a_config.num_services = 4;
    </script>

<script>
    function openModal() {
        document.getElementById("myModal").style.display = "flex";
        document.body.style.overflow = 'hidden'; // Disable scroll
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
        document.body.style.overflow = 'auto'; // Enable scroll
    }

    document.getElementById('closeModal').addEventListener('click', closeModal);
</script>

<script>
    var modal = document.getElementById("myModal");
    var overlay = document.getElementById("overlay");

    function openModal() {
        modal.style.display = "block";
        overlay.style.display = "block";
        document.body.style.overflow = 'hidden';
    }

    var closeModalButton = document.getElementById("closeModal");
    closeModalButton.onclick = function() {
        modal.style.display = "none";
        overlay.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == overlay) {
            modal.style.display = "none";
            overlay.style.display = "none";
        }
    }

</script>

<script async src="https://static.addtoany.com/menu/page.js"></script>
</x-app-layout>