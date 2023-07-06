<x-app-layout title="Paramètres du compte">
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="space-y-12">

            <!-- Update profile section -->
            <div>
                <h2 class="text-lg md:text-2xl py-4 px-6 bg-mint rounded-t-lg font-semibold text-white">Modifier le profil</h2>
                <div class="bg-white p-6 rounded-b-lg shadow-lg"> 
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
    
            <!-- Update password section -->
            <div>
                <h2 class="text-lg md:text-2xl py-4 px-6 bg-mint rounded-t-lg font-semibold text-white">Modifier le mot de passe</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete account section -->
            <div>
                <h2 class="text-lg md:text-2xl py-4 px-6 bg-mint rounded-t-lg font-semibold text-white">Supprimer le compte</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
       
    </div>
</x-app-layout>
