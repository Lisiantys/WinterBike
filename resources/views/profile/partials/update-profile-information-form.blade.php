<section class="flex flex-col md:flex-row">

    <img src="{{ asset('storage/' . $user->image_path) }}" alt="Image de profil de {{ $user->name }}" class="rounded-full w-36 h-36 mt-4 md:mr-4 mx-auto object-cover">

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6 w-full" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nom d\'utilisateur')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required minlength="3" maxlength="50" autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Adresse e-mail')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required maxlength="255" autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse e-mail n\'est pas vérifiée..') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex flex-col sm:flex-row  sm:items-center sm:justify-between space-y-6 sm:space-y-0">
            <input type="file" id="image_path" name="image_path" accept="image/jpeg,image/png,image/jpg,image/svg" max-size="600">
            
            <div class="flex flex-row-reverse items-center gap-4">
                <x-events.button-gradient type="submit">Enregistrer</x-events.button-gradient>

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 3000)"
                        class="text-lg text-dark-green font-bold"
                    >{{ __('Saved.') }}</p>
                @endif
            </div>
        </div>
    </form>
</section>
