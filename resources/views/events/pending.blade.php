<x-app-layout>
    <x-h1-title>
        Évènements en attentes
    </x-h1-title>

    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
        @forelse($pendingEvents as $event)
        <div class="event">
            <x-events.event-list :event="$event"/>
            <div class="flex justify-between">

                <form action="{{ route('events.validate', $event) }}" method="POST" class="w-1/2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="flex items-center justify-center bg-green-500 w-full h-8 lg:h-11 text-white"><i class="fa-solid fa-check fa-xl"></i></button>
                </form>
            
                @if(auth()->user()->role_id === 4)
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="w-1/2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="fromEventPending" value="pending">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');" class="flex items-center justify-center bg-red-500 w-full h-8 lg:h-11 text-white"><i class="fa-solid fa-trash-can fa-xl"></i></button>
                    </form>
                @endif
            </div>
            
        
            <form action="{{ route('events.storeStaffMessage', $event) }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <textarea name="staffMessage" id="staffMessage" class="w-full" required maxlength="255" minlength="10"></textarea>
                </div>
                <button type="submit" class="h-10 mt-2 mb-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Envoyer le message</button>
            </form>
        </div>
        
        @empty
            <p>Il n'y a pas de nouveaux évènements à accepter !</p>
        @endforelse
        <div>{{ $pendingEvents->links() }}</div>
    </div>
</x-app-layout>