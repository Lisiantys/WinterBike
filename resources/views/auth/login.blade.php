<x-guest-layout>
    <div class="flex justify-center py-4 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div class="flex flex-col items-center justify-center">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
                <h2 class="mt-6 text-center text-3xl font-extrabold text-blue-900">
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

                <div class="rounded-md shadow-sm -space-y-px">
                    <div>
                        <x-input-label for="email" :value="__('Adresse e-mail')" />
                        <x-text-input id="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="__('Mot de passe')" />
                        <x-text-input id="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center">
                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                        {{ __('Se souvenir de moi') }}
                    </label>
                </div>

                <div class="flex items-center justify-between flex-col">
                    <x-primary-button class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Connexion') }}
                    </x-primary-button>
                    <div class="text-sm mt-4">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-500">
                                {{ __('Mot de passe oublié ?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
