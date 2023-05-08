<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <style>
        .pagination nav{
            display: flex;
        }
        .pagination nav .hidden{
            display: flex;
        }
    </style>
</head>

<body>
    @include('events.partials.navbar')
    <h1>Gérer les Utilisateurs</h1>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('profile.manage') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher un utilisateur" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    
    <table>
        <thead>
            <tr>
                <th>Image de profil</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <img src="{{ Storage::url($user->image_path) }}" alt="Image de profil" width="50" height="50">
                    </td>
                    <td>
                        {{ $user->name }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->role->name }}
                    </td>
                    <td>
                        <form action="{{ route('profile.updateRole', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="role_id" onchange="this.form.submit()">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="pagination">{!! $users->appends(request()->query())->links() !!}</div>

</body>
</html>