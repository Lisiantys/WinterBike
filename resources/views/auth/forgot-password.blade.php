<x-guest-layout>
    <section class="min-h-screen flex bg-neutral-200 dark:bg-neutral-700">
        <div class="rounded-lg bg-white shadow-lg my-8 dark:bg-neutral-800 w-11/12 mx-auto lg:my-auto flex items-center justify-center">
            <div class="flex flex-col lg:flex-row-reverse lg:flex-wrap">
                <!-- Colonne de gauche -->
                <div class="px-4 md:px-0 lg:w-6/12">
                    <div class="mx-4 p-2 md:mx-6 md:p-12">
                        <div class="pb-6 pt-6 md:pt-0">
                            <i class="fa-solid fa-arrow-left"></i>
                            <a href="{{ route('index') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                {{ __('< Voir les événements') }}
                            </a>
                        </div>
                        <!-- Logo -->
                        <div class="text-center">
                            <x-application-logo class="mx-auto w-24 fill-current text-gray-500" />
                            <h2 class="mt-6 text-center text-3xl font-extrabold text-blue-900">
                                {{ __('Mot de passe oublié ?') }}
                            </h2>
                            <div class="my-4 text-sm text-gray-600">
                                {{ __('Aucun problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe qui vous permettra d\'en choisir un nouveau.') }}
                            </div>
                        </div>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <!-- Form -->
                        <form class="mt-8 space-y-6" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Adresse e-mail input -->
                            <div class="relative mb-4" data-te-input-wrapper-init>
                                <x-input-label for="email" :value="__('Adresse e-mail')" />
                                <x-text-input id="email" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Submit button -->
                            <div class="mb-12 pb-1 pt-1 text-center">
                                <x-primary-button class="flex justify-center w-full md:w-1/2 bg-gradient-to-r from-blue-500 to-green-500">
                                    {{ __('Envoyer') }}
                                </x-primary-button>
                            </div>
                        </form>
                        
                        <hr class="my-3 border-t" />
                        <div class="text-sm text-center mt-4">
                            <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                {{ __('Créer un compte !') }}
                            </a>
                        </div>
                        <div class="text-sm text-center mt-4 mb-4 md:mb-0">
                            <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                {{ __('Vous avez déjà un compte ? Connectez-vous !') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Colonne de droite -->
                <div class="hidden px-4 py-6 md:px-6 md:py-12 lg:flex items-center rounded-b-lg lg:w-6/12 lg:rounded-l-lg lg:rounded-br-none bg-gradient-to-r from-blue-500 to-green-500">
                    <div class="mx-4 p-2 md:mx-6 md:p-12 text-white">
                        <h4 class="mb-6 text-xl font-semibold">
                            Site en cours de construction...
                        </h4>
                        <p class="text-sm">
                            Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip ex
                            ea commodo consequat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
