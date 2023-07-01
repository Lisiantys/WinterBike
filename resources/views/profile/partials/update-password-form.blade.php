<section>
    <header>
        <p class="mt-1 text-base text-gray-600 font-semibold">
            {{ __('Assurez-vous d\'utiliser un mot de passe aléatoire avec un minimum 8 caractères.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" minlength="8" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer votre mot de passe')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" minlength="8" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-row-reverse items-center gap-4">
            <x-events.button-gradient type="submit" class="ml-auto">Enregistrer</x-events.button-gradient>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="text-lg text-dark-green font-bold"
                    >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
