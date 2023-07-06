<x-guest-layout>
    
    <!-- Colonne de droite -->
    <div class="px-4 py-6 md:px-6 md:py-12 flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none bg-gradient-to-r from-dark-green to-mint">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h2 class="mb-6 text-xl font-semibold">
                Site en cours de construction...
            </h2>
            <p class="text-base">
                Saisissez simplement vos identifiants dans les champs ci-dessous et vous serez prêt à explorer. Si vous avez oublié vos informations de connexion, ne vous inquiétez pas, nous sommes là pour vous aider à y accéder de nouveau.
            </p>
        </div>
    </div>   

    <!-- Colonne de gauche -->
    <div class="px-4 md:px-0 lg:w-6/12">
        <div class="mx-4 p-2 md:mx-6 md:p-12">
            @include('auth.partials.lien-evenements')

            <!--Logo + H1 -->
            <x-h1-logo-auth-view>Se connecter</x-h1-logo-auth-view>

            <x-auth-session-status class="mb-4 text-center text-sm text-red-600" :status="session('status')" />

            @if (session('error'))
                <div class="alert alert-danger text-center text-sm text-red-600">
                    {{ session('error') }}
                </div>
            @endif

            <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="hidden" name="remember" value="true">
                <!--Nom utilisateur-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')"/>
                </div>

                <!--Password utilisateur-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')"/>
                </div>

                <!--Remember me-->
                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-5 w-5 text-mint focus:ring-dark-green border-mint rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                <!--Bouton d'envoie-->
                <div class="mb-12 pb-1 pt-1 text-center">
                    <x-events.button-gradient type="submit" class="w-full md:w-1/2">
                        Connexion
                    </x-events.button-gradient>

                    <!--Mot de passe oublié-->
                    <div class="text-sm mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-medium text-dark-green hover:text-mint">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <div class="flex items-center justify-between pt-6 pb-6 md:pb-0">
                <p class="mb-0 mr-2">Créer un compte ?</p>
                <x-events.button-gradient href="{{ route('register') }}">S'enregistrer</x-events.button-gradient>
            </div>
        </div>
    </div>  
</x-guest-layout>
