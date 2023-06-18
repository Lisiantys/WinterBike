<x-guest-layout>
    <section class="min-h-screen flex bg-neutral-200 dark:bg-neutral-700">
        <div class="rounded-lg bg-white shadow-lg my-8 dark:bg-neutral-800 w-11/12 mx-auto lg:my-auto flex items-center justify-center">
            <div class="flex flex-col lg:flex-row lg:flex-wrap">
                <!-- Colonne de gauche-->
                <div class="px-2 md:px-0 lg:w-6/12">
                    <div class="mx-4 p-2 md:mx-6 md:p-12">
                        <div class="pb-6 pt-6 md:pt-0">
                            <i class="fa-solid fa-arrow-left"></i>
                            <a href="{{ route('index') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                {{ __('< Voir les événements') }}
                            </a>
                        </div>
                        <!--Logo-->
                        <div class="text-center">
                            <x-application-logo class="mx-auto w-24 fill-current text-gray-500" />
                            <h2 class="text-center text-3xl font-extrabold text-blue-900">
                                {{ __('Se connecter') }}
                            </h2>
                        </div>
    
                        <x-auth-session-status class="mb-4 text-center text-sm text-red-600" :status="session('status')" />

                        @if (session('error'))
                            <div class="alert alert-danger text-center text-sm text-red-600">
                                {{ session('error') }}
                            </div>
                        @endif
        
                        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                            @csrf
                            <input type="hidden" name="remember" value="true">
                            <!--Username input-->
                            <div class="relative mb-4" data-te-input-wrapper-init>
                            <x-input-label for="email" :value="__('Adresse e-mail')" />
                            <x-text-input id="email" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
        
                            <!--Password input-->
                            <div class="relative mb-4" data-te-input-wrapper-init>
                            <x-input-label for="password" :value="__('Mot de passe')" />
                            <x-text-input id="password" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>
        
                            <!--Remember me-->
                            <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                {{ __('Se souvenir de moi') }}
                            </label>
                            </div>

                            <!--Submit button-->
                            <div class="mb-12 pb-1 pt-1 text-center">
                                <x-primary-button class="flex justify-center w-full md:w-1/2 bg-gradient-to-r from-blue-500 to-green-500">
                                    {{ __('Connexion') }}
                                </x-primary-button>
                                <!--Forgot password link-->
                                <div class="text-sm mt-4">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <div class="flex items-center justify-between pt-6 pb-6 md:pb-0">
                            <p class="mb-0 mr-2">Créer un compte ?</p>
                            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-green-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                                S'enregister
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Colonne de droite -->
                <div class="px-4 py-6 md:px-6 md:py-12 flex items-center rounded-b-lg lg:w-6/12 lg:rounded-r-lg lg:rounded-bl-none bg-gradient-to-r from-blue-500 to-green-500">
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
