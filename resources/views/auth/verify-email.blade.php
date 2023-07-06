<x-guest-layout>
   <!-- Colonne de droite -->
    <div class="py-8 md:py-0 px-2 md:px-0 lg:w-1/2">
        <div class="p-2 mx-2 sm:mx-8 md:mx-0 2xl:mx-4 md:p-8">
            @include('auth.partials.lien-evenements')

            <!--Logo + H1 -->
            <x-h1-logo-auth-view>Vérifier votre adresse e-mail</x-h1-logo-auth-view>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('Un nouveau lien de vérification a été envoyé à l\'adresse e-mail que vous avez fournie lors de l\'inscription.') }}
                </div>
            @endif

            <div class="mt-8 space-y-2">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div class="mb:0 sm:mb-2 pb-1 pt-1 text-center">
                        <x-events.button-gradient type="submit" class="w-full md:w-1/2 lg:w-2/3">
                            Renvoyer un email
                        </x-events.button-gradient>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <div class="my-4 text-center">
                        <button type="submit" class="font-medium text-red-500 hover:text-red-600">
                            {{ __('Déconnexion') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Colonne de gauche -->
    <div class="hidden px-4 py-6 md:px-6 md:py-12 lg:flex items-center rounded-b-lg lg:w-1/2 lg:rounded-l-lg lg:rounded-br-none bg-gradient-to-r from-dark-green to-mint">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h2 class="mb-6 text-xl font-semibold">
                Bienvenue !
            </h2>
            <p class="text-base">
                Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n'avez pas reçu l'e-mail, nous pouvons vous en renvoyer un autre.
            </p>
        </div>
    </div>
</x-guest-layout>
