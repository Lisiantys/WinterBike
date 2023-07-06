<x-guest-layout>
    <!-- Colonne de droite -->
    <div class="px-4 md:px-0 lg:w-6/12">
        <div class="mx-4 p-2 md:mx-6 md:p-12">
            @include('auth.partials.lien-evenements')
            <!--Logo + H1 -->
            <x-h1-logo-auth-view>Mot de passe oublié ?</x-h1-logo-auth-view>
            
            <!-- Form -->
            <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Adresse e-mail input -->
                <div class="relative mb-1" data-te-input-wrapper-init>
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')"/>
                </div>
                <!-- Session Status -->
                <x-auth-session-status class="mx-auto mb-4" :status="session('status')" />
            
                <!-- Submit button -->
                <div class="mb-12 pb-1 pt-1 text-center">
                    <x-events.button-gradient type="submit" class="w-full md:w-1/2">
                        Envoyer
                    </x-events.button-gradient>         
                </div>
            </form>
            
            <hr class="my-3 border-t" />
            <div class="text-sm text-center mt-4">
                <a href="{{ route('register') }}" class="font-medium text-dark-green hover:text-mint">
                    {{ __('Créer un compte !') }}
                </a>
            </div>
            <div class="text-sm text-center mt-4 mb-4 md:mb-0">
                <a href="{{ route('login') }}" class="font-medium text-dark-green hover:text-mint">
                    {{ __('Vous avez déjà un compte ? Connectez-vous !') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Colonne de gauche -->
    <div class="hidden px-4 py-6 md:px-6 md:py-12 lg:flex items-center rounded-b-lg lg:w-6/12 lg:rounded-l-lg lg:rounded-br-none bg-gradient-to-r from-dark-green to-mint">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h2 class="mb-6 text-xl font-semibold">
                Réinitialisation de votre mots de passe
            </h2>
            <p class="text-base">
                Aucun soucis. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d'en choisir un nouveau.
            </p>
        </div>
    </div>
</x-guest-layout>
