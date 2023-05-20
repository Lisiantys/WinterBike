<x-app-layout>
    <div class="container">
        <x-h1-title>
            Retrouvez les évènements en France
        </x-h1-title>

        <a href="#" onclick="toggleSearchForm()">les filtres de recherche</a>

        <form action="{{ route('events.index') }}" method="get" class="m-5 max-w-7xl w-11/12 mx-auto hidden" id="searchForm">
            <div class="flex items-center space-x-3">
                <label for="keyword" class="font-medium text-gray-700">Mot-clé :</label>
                <input type="text" name="keyword" id="keyword" value="{{ $request->input('keyword') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="flex items-center space-x-3">
                <label for="department_id" class="font-medium text-gray-700">Département :</label>
                <select name="departement" id="departement" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Sélectionnez un département</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-3">
                <label for="region_id" class="font-medium text-gray-700">Région :</label>
                <select name="region" id="region" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Sélectionnez une région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-3">
                <label for="type_id" class="font-medium text-gray-700">Type d'événement :</label>
                <select name="type" id="type" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Sélectionnez un type d'événement</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center space-x-3">
                <label for="beginning" class="font-medium text-gray-700">Date de début :</label>
                <input type="date" name="beginning" id="beginning" value="{{ $request->input('beginning') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="flex items-center space-x-3">
                <label for="end" class="font-medium text-gray-700">Date de fin :</label>
                <input type="date" name="end" id="end" value="{{ $request->input('end') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="flex justify-center">
                <button type="submit" class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Rechercher</button>
            </div>
        </form>

        <a href="{{ route('events.create') }}">Créer un évènement</a>

        <div style="display:flex;">
            <div class="top-favorites">
                <h2>Événements les plus populaires</h2>
            
                @foreach($topFavorites as $event)
                    <div>
                        <x-events.event-list :event="$event" />
    
                    </div>
                @endforeach
            </div>
    
            <div>
                @forelse ($events as $event)   
                    <x-events.event-list :event="$event" class="bg-red-600" />
                @empty
                    <p>Il n'y a pas d'événement avec ces options de recherche.</p>
                @endforelse
                <div>{{ $events->withQueryString()->links() }}</div>
            </div>
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