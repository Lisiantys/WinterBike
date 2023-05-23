<x-app-layout>
    <x-h1-title>
        Retrouvez les évènements en France
    </x-h1-title>

    <a onclick="toggleSearchForm()" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">
        + Filtres de recherche
    </a>
        
    <div class="mx-auto flex">
        <div class="h-10 my-2 rounded-md bg-gradient-to-r from-blue-500 to-green-500 p-1">
            <div class="flex h-full w-full items-center justify-center bg-white">
                <a href="{{ route('events.create') }}" class="text-base px-4 font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-green-500">Créer un évènement</a>
            </div>
        </div>
    </div>

    
    <form action="{{ route('events.index') }}" method="get" class="m-5 max-w-7xl w-full mx-auto grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3" id="searchForm">
        <div>
            <label for="keyword" class="font-medium text-gray-700">Mot-clé :</label>
            <input type="text" name="keyword" id="keyword" value="{{ $request->input('keyword') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
        </div>
        <div>
            <label for="department_id" class="font-medium text-gray-700">Département :</label>
            <select name="departement" id="departement" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                <option value="">Sélectionnez un département</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="region_id" class="font-medium text-gray-700">Région :</label>
            <select name="region" id="region" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                <option value="">Sélectionnez une région</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="type_id" class="font-medium text-gray-700">Type d'événement :</label>
            <select name="type" id="type" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                <option value="">Sélectionnez un type d'événement</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="beginning" class="font-medium text-gray-700">Date de début :</label>
            <input type="date" name="beginning" id="beginning" value="{{ $request->input('beginning') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
        </div>
        <div>
            <label for="end" class="font-medium text-gray-700">Date de fin :</label>
            <input type="date" name="end" id="end" value="{{ $request->input('end') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
        </div>
        <div class="flex justify-center col-span-full">
            <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Rechercher</button>
        </div>
    </form>
        
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            @forelse ($events as $event)   
                <x-events.event-list :event="$event"/>
            @empty
                <p>Il n'y a pas d'événement avec ces options de recherche.</p>
            @endforelse
            <div>{{ $events->withQueryString()->links() }}</div>
        </div>
        <div>
            @foreach($topFavorites as $event)
                <div>
                    <x-events.event-list :event="$event" />
                </div>
            @endforeach
        </div>
    </div>
    
    <script>
        function toggleSearchForm() {
            var form = document.getElementById('searchForm');
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script> 
</x-app-layout>