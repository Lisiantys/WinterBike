<x-app-layout>
    <x-h1-title>
        Gérer les utilisateurs
    </x-h1-title>
    
    <form action="{{ route('profile.manage') }}" method="GET" class="mb-6 space-y-4 max-w-7xl w-11/12 mx-auto">
        <div class="flex items-center">
            <input type="text" name="search" placeholder="Rechercher un utilisateur" value="{{ request('search') }}" class="border border-gray-300 rounded-lg py-2 px-3 flex-grow focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md ml-2 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Rechercher</button>
        </div>
    
        <div class="flex space-x-4">
            <div class="relative inline-block w-full">
                <label for="filter-role" class="text-gray-700">Filtrer par rôle :</label>
                <select name="role_id" id="filter-role" onchange="this.form.submit()" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les grades</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="relative inline-block w-full">
                <label for="filter-ban" class="text-gray-700">Filtrer par statut de bannissement :</label>
                <select name="is_banned" id="filter-ban" onchange="this.form.submit()" class="block appearance-none w-full bg-white border border-gray-300 hover:border-gray-400 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Tous les utilisateurs</option>
                    <option value="banned" {{ request('is_banned') == 'banned' ? 'selected' : '' }}>Utilisateurs bannis</option>
                    <option value="not_banned" {{ request('is_banned') == 'not_banned' ? 'selected' : '' }}>Utilisateurs non bannis</option>
                </select>
            </div>
        </div>
    </form>
    
    
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5 max-w-7xl w-11/12 mx-auto">    
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Nom</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Vérifier</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Rôle</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Bloquer</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4 text-sm flex items-center">
                            <img src="{{ Storage::url($user->image_path) }}" alt="Image de profil" class="rounded-full w-14">
                            <div class="pl-1">
                                <div class="font-medium text-gray-700">{{ $user->name }}</div>
                                <div class="text-gray-400"> {{ $user->email }}</div> 
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($user->email_verified_at)
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2 py-1 text-xs font-semibold text-green-600">
                                Vérifié
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-600">
                                Non vérifié
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('profile.updateRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="relative inline-block w-full">
                                    <select name="role_id" onchange="this.form.submit()" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            @if(!$user->is_banned)
                                <form action="{{ route('profile.banUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="hover:text-red-600" onclick="return confirm('Voulez vous bannir {{ $user->name }}?');">Bannir</button>
                                </form>
                            @else
                                <form action="{{ route('profile.unbanUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600" onclick="return confirm('Voulez vous débannir {{ $user->name }}?');">Débannir</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <x-events.empty-message>
                        Aucun utilisateur a été trouvé.
                    </x-events.empty-message>
                @endforelse
            </tbody>
        </table>
        <div class="px-4">{{ $users->withQueryString()->links('vendor.pagination.custom') }}</div>

    </div>
</x-app-layout>