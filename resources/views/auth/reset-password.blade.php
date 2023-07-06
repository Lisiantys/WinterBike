<x-guest-layout>
<!-- Colonne de droite -->
    <div class="py-8 md:py-0 px-2 md:px-0 lg:w-5/12">
        <div class="p-2 mx-2 sm:mx-8 md:mx-0 2xl:mx-4 md:p-8">
            @include('auth.partials.lien-evenements')

            <!--Logo + H1 -->
            <x-h1-logo-auth-view>Réinitialiser le mot de passe</x-h1-logo-auth-view>

            <div class="mt-8 space-y-2">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Adresse e-mail')" />
                        <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')"/>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Mot de passe')" />
                        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')"/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />

                        <x-text-input id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')"/>
                    </div>

                    <div class="mb:0 sm:mb-2 pb-1 pt-1 mt-4 text-center">
                        <x-events.button-gradient type="submit" class="w-full md:w-1/2">
                            Réinitialiser le mot de passe
                        </x-events.button-gradient>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Colonne de gauche -->
    <div class="hidden px-4 py-6 md:px-6 md:py-12 lg:flex items-center rounded-b-lg lg:w-7/12 lg:rounded-l-lg lg:rounded-br-none bg-gradient-to-r from-mint to-dark-green">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h2 class="mb-6 text-xl font-semibold">
                Nous sommes là pour vous aider !
            </h2>
            <p class="text-base">
                Si vous avez oublié votre mot de passe, ne vous inquiétez pas. Entrez simplement votre adresse e-mail et nous vous aiderons à en créer un nouveau.
            </p>
        </div>
    </div>
</x-guest-layout>
