<header>
    <nav>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
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
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endguest
            </div>
        @endif
    </nav>
</header>