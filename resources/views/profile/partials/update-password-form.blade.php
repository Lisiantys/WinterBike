<section>
    <header>
        <ul class="list-disc mt-1 text-sm sm:text-base text-gray-600 font-semibold">Le mot de passe doit contenir :
            <li class="ml-8">au moins 12 caractères.</li>
            <li class="ml-8">au moins une majuscule et une minuscule.</li>
            <li class="ml-8">au moins un symbole (!, / ,@ ?, ^, ...).</li>
            <li class="ml-8">au moins 1 chiffre.</li>
        </ul>
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
            <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" minlength="12" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirmer votre mot de passe')" />
            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" minlength="12" autocomplete="new-password" />
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
