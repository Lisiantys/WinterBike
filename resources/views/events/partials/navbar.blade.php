<header>
    <nav>
        
        @auth
        <p>Bonjour : {{ auth()->user()->name }}</p>
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
                <li><a href="{{ route('events.myEvents') }}">Mes Évènements</a></li>
                <li><a href="{{ route('events.pending') }}">Évènements en attente</a></li>
                <li><a href="">Gérer les Utilisateurs</a></li>
            </ul>
        @endauth
        @guest
            <ul>
                <li><a href="{{ route('index') }}">Évènement</a></li>
            </ul>
        @endguest
    </nav>
</header>