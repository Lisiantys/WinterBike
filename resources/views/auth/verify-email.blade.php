<x-guest-layout>
   <!-- Colonne de gauche -->
    <div class="py-8 md:py-0 px-2 md:px-0 lg:w-1/2">
        <div class="p-2 mx-2 sm:mx-8 md:mx-0 2xl:mx-4 md:p-8">
            <div class="pb-6 pt-0">
                <i class="fa-solid fa-arrow-left"></i>
                <a href="{{ route('index') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    {{ __('Voir les événements') }}
                </a>
            </div>
            <div class="text-center">
                <x-application-logo class="mx-auto w-24 fill-current text-gray-500" />
                <h2 class="mt-6 text-center text-2xl font-extrabold text-black">
                    {{ __('Vérifiez votre adresse e-mail') }}
                </h2>
            </div>
            <div class="mb-4 text-sm text-gray-600 mt-6">
                {{ __('Avant de commencer, pourriez-vous vérifier votre adresse e-mail en cliquant sur le lien que nous venons de vous envoyer par e-mail ? Si vous n\'avez pas reçu l\'e-mail, nous serons heureux de vous en renvoyer un autre.') }}
            </div>

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
                        <button type="submit" class="underline font-medium text-blue-600 hover:text-blue-500">
                            {{ __('Déconnexion') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Colonne de droite -->
    <div class="hidden px-4 py-6 md:px-6 md:py-12 lg:flex items-center rounded-b-lg lg:w-1/2 lg:rounded-l-lg lg:rounded-br-none bg-gradient-to-r from-dark-green to-mint">
        <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
            <h4 class="mb-6 text-xl font-semibold">
                Bienvenue !
            </h4>
            <p class="text-sm">
                Nous sommes ravis de vous accueillir parmi nous. Pour continuer, veuillez vérifier votre adresse e-mail.
            </p>
        </div>
    </div>
</x-guest-layout>
