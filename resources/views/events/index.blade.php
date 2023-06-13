<x-app-layout>
    <x-h1-title>
        Retrouvez les évènements en France
    </x-h1-title>

    <div class="w-full flex flex-col sm:flex-row">
        <form action="{{ route('events.index') }}" method="get" class="w-full sm:w-1/2 sm:pr-2 lg:mt-0" id="searchForm">
            <div>
                <label for="keyword" class="font-medium text-gray-700">Mot-clé :</label>
                <input type="text" name="keyword" id="keyword" value="{{ $request->input('keyword') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="mb-4">
                <label for="department_id" class="font-medium text-gray-700">Département :</label>
                <select name="departement" id="departement" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                    <option value="">Sélectionnez un département</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" {{ $request->input('departement') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="region_id" class="font-medium text-gray-700">Région :</label>
                <select name="region" id="region" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                    <option value="">Sélectionnez une région</option>
                    @foreach ($regions as $region)
                        <option value="{{ $region->id }}" {{ $request->input('region') == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="type_id" class="font-medium text-gray-700">Type d'événement :</label>
                <select name="type" id="type" class="block appearance-none w-full bg-white border border-gray-200 px-3 py-2 pr-8 rounded focus:outline-none focus:border-blue-300">
                    <option value="">Sélectionnez un type d'événement</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $request->input('type') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="beginning" class="font-medium text-gray-700">Date de début :</label>
                <input type="date" name="beginning" id="beginning" value="{{ $request->input('beginning') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="mb-4">
                <label for="end" class="font-medium text-gray-700">Date de fin :</label>
                <input type="date" name="end" id="end" value="{{ $request->input('end') }}" class="border border-gray-200 rounded px-3 py-2 focus:outline-none focus:border-blue-300 w-full">
            </div>
            <div class="flex justify-center col-span-full">
                <button type="submit" class="h-10 font-semibold bg-gradient-to-r from-blue-500 to-green-500 text-white py-2 px-4 rounded text-base">Rechercher</button>
            </div>
        </form>
        <div class="w-full sm:w-1/2 sm:pl-2">
            @foreach($topFavorites as $event)
                <div>
                    <x-events.event-list :event="$event" :isTopFavorite="true" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="w-full">
        <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse ($events as $event)
                <x-events.event-list :event="$event"/>
            @empty
                <x-events.empty-message>
                    Aucun événement trouvé avec ces options de recherche.
                </x-events.empty-message>
            @endforelse
        </div>
        <div>{{ $events->withQueryString()->links('vendor.pagination.custom') }}</div>
    </div>

</x-app-layout>