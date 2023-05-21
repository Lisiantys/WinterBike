<nav x-data="{ open: false }" class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">

          {{-- OK --}}

        <div class="flex items-center justify-between">
      
            <a href="https://winterbike.fr" class="flex ml-2 md:mr-24">
                {{-- <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Winter Bike</span>
                --}}
                <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
            </a> 

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center lg:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    @auth
                        <x-responsive-nav-link  :href="route('events.index')" :active="request()->routeIs('events.index')">
                            {{ __('Évènements') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link  :href="route('events.myEvents')" :active="request()->routeIs('events.myEvents')">
                            {{ __('Mes évènements') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link  :href="route('events.favorite')" :active="request()->routeIs('events.favorite')">
                            {{ __('Mes favoris') }}
                        </x-responsive-nav-link>
                        @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
                            <x-responsive-nav-link  :href="route('events.pending')" :active="request()->routeIs('events.pending')">
                                {{ __('Évènements en attentes') }}
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
                            {{ __('Évènements') }}
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
                                {{ __('Mon profile') }}
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
            {{-- ok --}}
        </div>
    </div>
</nav>
  
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 lg:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">     
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @auth
                <div class="flex flex-col justify-center max-w-xs rounded-xl sm:px-12">
                    <img src="{{ asset('storage/'.Auth::user()->image_path) }}" alt="User Avatar">                
                    <div class="text-center">
                        <div class="my-2 space-y-1">
                            <h2 class="px-5 text-xs sm:text-base dark:text-gray-400">{{ Auth::user()->name }}</h2>
                            <p class="px-5 text-xs sm:text-base dark:text-gray-400">{{ Auth::user()->role->name }}</p>
                        </div>
                    </div>
                </div>

                <li>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Évènements') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('events.myEvents')" :active="request()->routeIs('events.myEvents')">
                        {{ __('Mes évènements') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('events.favorite')" :active="request()->routeIs('events.favorite')">
                        {{ __('Mes favoris') }}
                    </x-nav-link>
                </li>
                @if(auth()->user()->role_id === 3 || auth()->user()->role_id === 4)
                    <li>
                        <x-nav-link :href="route('events.pending')" :active="request()->routeIs('events.pending')">
                            {{ __('Évènements en attentes') }}
                        </x-nav-link>
                    </li>
                @endif
                @if(auth()->user()->role_id === 4)
                    <li>
                        <x-nav-link :href="route('profile.manage')" :active="request()->routeIs('profile.manage')">
                            {{ __('Gérer les utilisateurs') }}
                        </x-nav-link>
                    </li>
                @endif
                <li>
                    <x-nav-link :href="route('profile.show', Auth::id())">
                        {{ __('Mon profile') }}
                    </x-nav-link>
                </li>
                <li>
                    <x-nav-link :href="route('profile.edit')">
                        {{ __('Paramètres') }}
                    </x-nav-link>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Déconnexion') }}
                        </x-nav-link>
                    </form>
                </li>
            @endauth
            @guest
                <li>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.index')">
                        {{ __('Évènements') }}
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
     </div>
  </aside>
  