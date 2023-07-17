{{-- Nav mobile < 1024px --}}
<nav x-data="{ open: false }" class="fixed top-0 z-40 w-full bg-white border-b border-dark-green">
    <div x-show="open" class="fixed inset-0 -z-30 bg-black opacity-50 lg:hidden"></div>

    <div class="z-50 bg-white border-b-2 border-dark-green px-3 py-2 lg:px-5 lg:hidden">
        <div class="flex items-center justify-between">
            <a href="https://winterbike24.fr" class="flex ml-2 md:mr-24">
                <x-application-logo class="w-16 h-16" />
            </a>
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-dark-green hover:text-mint hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-dark-green transition duration-150 ease-in-out">
                    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden absolute w-full top-18 bg-white z-50 border-b border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('events.create')" class="h-10 font-semibold bg-gradient-to-r from-dark-green to-mint text-white py-2 px-4 rounded text-base">
                    Créer un événement
                </x-responsive-nav-link>
                <x-responsive-nav-link  :href="route('events.index')" :active="request()->routeIs('events.index')">
                    {{ __('Événements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link  :href="route('events.myEvents')" :active="request()->routeIs('events.myEvents')">
                    {{ __('Mes événements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link  :href="route('events.favorite')" :active="request()->routeIs('events.favorite')">
                    {{ __('Mes favoris') }}
                </x-responsive-nav-link>
                @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
                    <x-responsive-nav-link  :href="route('events.pending')" :active="request()->routeIs('events.pending')">
                        {{ __('Événements en attentes') }}
                    </x-responsive-nav-link>
                @endif
                @if(auth()->user()->role_id === 4)
                    <x-responsive-nav-link  :href="route('profile.manage')" :active="request()->routeIs('profile.manage')">
                        {{ __('Gérer les Utilisateurs') }}
                    </x-responsive-nav-link>
                @endif
            @endauth
            @guest
                <x-responsive-nav-link  :href="route('events.index')" :active="request()->routeIs('events.index')">
                    {{ __('Événements') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link  :href="route('login')" :active="request()->routeIs('login')">
                    {{ __('Connexion') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link  :href="route('register')" :active="request()->routeIs('register')">
                    {{ __('Inscription') }}
                </x-responsive-nav-link>
            @endguest
        </div>
        @auth
            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.show', Auth::id())">
                        {{ __('Mon profil') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Paramètres') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Déconnexion') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>
  
{{-- Nav ordinateur > 1024px --}}
<aside id="logo-sidebar" class="fixed top-0 left-0 z-30 w-64 h-screen transition-transform -translate-x-full  border-r border-gray-200 lg:translate-x-0" aria-label="Sidebar">     
    <div class="flex flex-col justify-between h-full p-3 overflow-y-auto">
        <ul class="space-y-1">
            @auth
                <div class="flex flex-col items-center p-2 mb-4">
                    <img src="{{ asset('storage/'.Auth::user()->image_path) }}" alt="User Avatar" class="w-24 h-24 rounded-full object-cover">                
                    <div class="flex flex-col items-center ">
                        <h2 class="text-lg font-semibold">{{ Auth::user()->name }}</h2>
                        <span class="flex items-center">
                            <p class="text-xs font-semibold uppercase">{{ Auth::user()->role->name }}</p>
                        </span>
                    </div>
                    <li class="mt-6">
                        <x-events.button-gradient href="{{ route('events.create') }}">Créer un événement</x-events.button-gradient>
                    </li>
                </div>

                <li>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        <i class="fa-solid fa-magnifying-glass pr-2"></i>
                        {{ __('Événements') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('events.myEvents')" :active="request()->routeIs('events.myEvents')">
                        <i class="fa-solid fa-pencil pr-2"></i>
                        {{ __('Mes événements') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('events.favorite')" :active="request()->routeIs('events.favorite')">
                        <i class="fa-solid fa-star pr-2"></i>
                        {{ __('Mes favoris') }}
                    </x-nav-link>
                </li>
                @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
                    <li>
                        <x-nav-link :href="route('events.pending')" :active="request()->routeIs('events.pending')">
                            <i class="fa-solid fa-list-ul pr-2"></i>
                            {{ __('En attentes') }}
                        </x-nav-link>
                    </li>
                @endif
                @if(auth()->user()->role_id === 4)
                    <li>
                        <x-nav-link :href="route('profile.manage')" :active="request()->routeIs('profile.manage')">
                            <i class="fa-solid fa-screwdriver-wrench pr-2"></i>
                            {{ __('Gérer les utilisateurs') }}
                        </x-nav-link>
                    </li>
                @endif
                <hr>
                <li>
                    <x-nav-link :href="route('profile.show', Auth::id())">
                        <i class="fa-solid fa-circle-user pr-2"></i>
                        {{ __('Mon profil') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('profile.edit')">
                        <i class="fa-solid fa-gear pr-2"></i>
                        {{ __('Paramètres') }}
                    </x-nav-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            <i class="fa-solid fa-door-open pr-2"></i>
                            {{ __('Déconnexion') }}
                        </x-nav-link>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Événements') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Connexion') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                        {{ __('Inscription') }}
                    </x-nav-link>
                </li>
            @endguest
        </ul>
            
        <div class="flex items-center ">
            <div>
                <x-application-logo class="w-12 h-12 mx-auto"/>
            </div>
            <h2 class="text-xl">
                Winter Bike
            </h2>
        </div>
    </div>
</aside>
  