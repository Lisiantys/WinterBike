<div class="bg-white shadow-lg rounded-lg border h-full border-gray-200">
    <div class="flex flex-row justify-between items-center h-full">
        <div class="w-14 mr-4 flex flex-col items-center justify-center space-y-4 rounded-l-lg h-full bg-gradient-to-t from-dark-green to-mint">
            <p class="text-xl font-bold
                @if($rank == 1) text-yellow-400 
                @elseif($rank == 2) text-slate-400 
                @elseif($rank == 3) text-yellow-700 
                @endif">{{ $event->favoritedBy->count() }}</p>
            <i class="fa-solid fa-star fa-xl 
                @if($rank == 1) text-yellow-400 
                @elseif($rank == 2) text-slate-400 
                @elseif($rank == 3) text-yellow-700 
                @endif"></i>
        </div>
        <a href="{{ route('events.show', $event->id) }}" class="flex-grow my-2">
            <h2 class="block text-lg md:text-xl leading-tight font-bold text-transparent bg-clip-text bg-gradient-to-r from-dark-green to-mint">{{ Str::limit($event->name , $limit = 28, $end = '...') }}</h2>
            <p class="mt-2 text-gray-600">Du <span class="font-semibold">{{ \Carbon\Carbon::parse($event->beginningDate)->format('d/m/Y') }}</span> au <span class="font-semibold">{{ \Carbon\Carbon::parse($event->endDate)->format('d/m/Y') }}</span> - <span class="font-semibold">{{ $event->type->name }}</span></p>
            <p class="mt-2 text-gray-600 font-semibold">{{ $event->region->name }} - {{ $event->department->name }}</p>
        </a>
    </div>
</div>
