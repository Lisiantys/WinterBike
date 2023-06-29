<x-app-layout title="Événements en attentes">
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
        @forelse($pendingEvents as $event)
        <div class="event">
            <x-events.event-list :event="$event"/>
            <div class="flex justify-between">

                <form action="{{ route('events.validate', $event) }}" method="POST" class="w-1/2">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="flex items-center justify-center bg-green-500 w-full rounded-l h-8 lg:h-11 text-white"><i class="fa-solid fa-check fa-xl"></i></button>
                </form>
            
                @if(auth()->user()->role_id === 4)
                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="w-1/2">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="fromEventPending" value="pending">
                        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet événement?');" class="flex items-center justify-center bg-red-500 w-full rounded-r h-8 lg:h-11 text-white"><i class="fa-solid fa-trash-can fa-xl"></i></button>
                    </form>
                @endif
            </div>
            
            <form action="{{ route('events.storeStaffMessage', $event) }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <textarea name="staffMessage" id="staffMessage" class="w-full rounded" required maxlength="255" minlength="10"></textarea>
                    @error('staffMessage')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <x-events.button-gradient type="submit">Envoyer le message</x-events.button-gradient>
            </form>
        </div>
        
        @empty
            <x-events.empty-message>
                Aucun événement en attente d'approbation.
            </x-events.empty-message>
        @endforelse
    </div>
    <div>{{ $pendingEvents->links('vendor.pagination.custom') }}</div>

</x-app-layout>