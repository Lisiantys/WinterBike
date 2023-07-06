<div class="bg-white  rounded-lg shadow-lg mb-4">
    <div class="p-4 divide-y divide-gray-200 ">
        <div class="flex justify-between items-start mb-2">
            <div class="flex items-center space-x-4">
                @if (isset($isProfilComment) && $isProfilComment)
                    <div class="flex items-center ">
                        <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image de l'utilisateur" class="rounded-full w-12 h-12 object-cover">                    
                        <div class="flex flex-col mb-2 ml-2">
                            <p><strong>{{ $comment->user->name }}</strong> a posté un commentaire sur <strong><a href="{{ route('events.show', $comment->event->id) }}" class="text-base font-bold text-transparent bg-clip-text bg-gradient-to-r from-dark-green to-mint">{{ $comment->event->name }}</a></strong></p>
                            <span class="text-xs text-gray-500 ">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</span>
                        </div>
                    </div>
                @else
                    <img src="{{ Storage::url($comment->user->image_path) }}" alt="Image" class="w-12 h-12 rounded-full object-cover">
                    <div>
                        <h4 class="font-semibold text-gray-900 ">
                            <a href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->name }}</a>
                        </h4>
                        <span class="text-xs text-gray-500 ">{{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('LLL') }}</span>
                    </div>
                @endif
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
            <p class="text-base text-black-800">{{ $comment->description }}</p>
        </div>
    </div>
</div>
