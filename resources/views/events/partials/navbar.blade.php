<header>
    <nav>
        
        @auth
        <p>Bonjour : {{ auth()->user()->name }}</p>
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
                <li><a href="{{ route('events.myEvents') }}">Mes Évènements</a></li>
                @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
                    <li><a href="{{ route('events.pending') }}">Évènements en attente</a></li>
                @endif
                @if(auth()->user()->role_id === 4)
                    <li><a href="{{ route('profile.manage') }}">Gérer les Utilisateurs</a></li>
                @endif
            </ul>
        @endauth
        @guest
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
            </ul>
        @endguest
    </nav>
</header>