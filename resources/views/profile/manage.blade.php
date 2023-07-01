<x-app-layout title="Gestion des utilisateurs">

    <form action="{{ route('profile.manage') }}" method="GET" class="mb-6 space-y-4 mx-auto flex sm:flex-col-reverse flex-col">
        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
            <div class="relative inline-block w-full">
                <x-events.select-field name="role_id" label="Filtrer par rôle" :value="request('role_id')" onchange="this.form.submit()">
                    <option value="">Tous les grades</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </x-events.select-field>
            </div>
    
            <div class="relative inline-block w-full">
                <x-events.select-field name="is_banned" label="Filtrer par statut de bannissement" :value="request('is_banned')" onchange="this.form.submit()">
                    <option value="">Tous les utilisateurs</option>
                    <option value="banned" {{ request('is_banned') == 'banned' ? 'selected' : '' }}>Utilisateurs bannis</option>
                    <option value="not_banned" {{ request('is_banned') == 'not_banned' ? 'selected' : '' }}>Utilisateurs non bannis</option>
                </x-events.select-field>
            </div>
        </div>
    
        <div class="flex flex-col sm:flex-row sm:items-end ">
            <div class="flex-grow">
                <x-events.input-field type="text" name="search" label="Rechercher un utilisateur" :value="request('search')" />
            </div>
            <x-events.button-gradient type="submit">Rechercher</x-events.button-gradient>
        </div>
        
        
    </form>


    
    <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5 mx-auto">    
        <table class="w-full border-collapse bg-white text-left text-sm text-gray-500">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Noms utilisateurs</th>
                    <th scope="col" class="hidden sm:table-cell px-6 py-4 font-medium text-gray-900">Vérifier</th>
                    <th scope="col" class="hidden sm:table-cell  px-6 py-4 font-medium text-gray-900">Rôles</th>
                    <th scope="col" class="px-6 py-4 font-medium text-gray-900">Bloquer</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4 text-sm">
                            <div class="flex items-center mb-2 sm:mb-0">
                                <img src="{{ Storage::url($user->image_path) }}" alt="Image de profil" class="rounded-full w-12 h-12 object-cover">
                                <div class="pl-2">
                                    <div>
                                        <a href="{{ route('profile.show', $user->id ) }}" class="text-gray-700 font-medium hover:text-mint">{{ $user->name }}</a>
                                    </div>
                                    <a href="mailto:{{ $user->email }}" class="text-gray-400 hover:text-dark-green">{{ $user->email }}</a>
                               
                                    <div class="block sm:hidden"> 
                                        @if($user->email_verified_at)
                                        <span class="inline-flex items-center rounded-full text-xs font-semibold text-green-600">
                                            Vérifié
                                        </span>
                                        @else
                                        <span class="inline-flex items-center rounded-full text-xs font-semibold text-red-600">
                                            Non vérifié
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="block sm:hidden"> 
                                <form action="{{ route('profile.updateRole', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="relative inline-block w-full">
                                        <x-events.select-field name="role_id" onchange="this.form.submit()">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @endforeach
                                        </x-events.select-field>
                                    </div>
                                </form>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden sm:table-cell">
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
                        
                        <td class="px-6 py-4 hidden sm:table-cell">
                            <form action="{{ route('profile.updateRole', $user->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="relative inline-block w-full">
                                    <x-events.select-field name="role_id" onchange="this.form.submit()">
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    </x-events.select-field>
                                </div>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            @if(!$user->is_banned)
                                <form action="{{ route('profile.banUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="hover:text-red-600" onclick="return confirm('Voulez vous bloquer {{ $user->name }}?');">Bloquer</button>
                                </form>
                            @else
                                <form action="{{ route('profile.unbanUser', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="text-red-600" onclick="return confirm('Voulez vous débloquer {{ $user->name }}?');">Débloquer</button>
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