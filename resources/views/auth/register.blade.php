<x-guest-layout>

    <!-- Colonne de droite -->
    <div class="px-4 py-6 md:px-6 md:py-12 flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none bg-gradient-to-r from-dark-green to-mint">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h2 class="mb-6 text-xl font-semibold">
                Bienvenue sur Winterbike ! 
            </h2>
            <p class="text-base">
                Nous sommes ravis de vous voir ici ! Remplissez simplement les informations requises ci-dessous pour créer un compte. Une fois cette étape franchie, vous serez prêt à profiter de toutes les fonctionnalités que nous avons à offrir. Ne vous inquiétez pas, nous gardons vos données en sécurité.
            </p>
        </div>
    </div>

    <!-- Colonne de gauche-->
    <div class="px-4 md:px-0 lg:w-6/12">
        <div class="mx-4 p-2 md:mx-6 md:p-12">
            @include('auth.partials.lien-evenements')

            <!--Logo + H1 -->
            <x-h1-logo-auth-view>Créer un compte</x-h1-logo-auth-view>

            <form class="mt-8 space-y-2" method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="remember" value="true">

                <!--Nom d'utilisateur input-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="name" :value="__('Nom d\'utilisateur')" />
                    <x-text-input id="name" type="text" name="name" :value="old('name')" minlength="3" maxlength="50" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')"/>
                </div>

                <!--Adresse e-mail input-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="email" :value="__('Adresse e-mail')" />
                    <x-text-input id="email" type="email" name="email" :value="old('email')" maxlength="255" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')"/>
                </div>

                <!--Mot de passe input-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" type="password" name="password" required autocomplete="new-password" minlength="12" />
                    <x-input-error :messages="$errors->get('password')"/>
                    <ul class="list-disc">Le mot de passe doit contenir :
                        <li class="ml-8">au moins 12 caractères.</li>
                        <li class="ml-8">au moins une majuscule et une minuscule.</li>
                        <li class="ml-8">au moins un symbole (!, / ,@ ?, ^, ...).</li>
                        <li class="ml-8">au moins 1 chiffre.</li>
                    </ul>
                </div>

                <!--Confirmer le mot de passe input-->
                <div class="relative mb-4" data-te-input-wrapper-init>
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" minlength="12" />
                    <x-input-error :messages="$errors->get('password_confirmation')"/>
                </div>

                <!--Submit button-->
                <div class="mb-12 pb-1 pt-1 text-center">
                    <x-events.button-gradient type="submit" class="w-full md:w-1/2">
                        S'enregistrer
                    </x-events.button-gradient>
                </div>
            </form>
            <div class="flex flex-col sm:flex-row items-center justify-between pt-6 pb-6 md:pb-0">
                <p class="mb-0 mr-2">Vous avez déjà un compte ?</p>
                <x-events.button-gradient href="{{ route('login') }}">
                    Se connecter
                </x-events.button-gradient>
            </div>
        </div>
    </div>
    
</x-guest-layout>
