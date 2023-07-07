<x-app-layout>
<div class="bg-gray-50 h-screen flex items-center justify-center rounded-lg">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h1 class="font-bold text-xl md:text-2xl lg:text-3xl text-transparent bg-gradient-to-r bg-clip-text from-dark-green to-mint">404 - Page Introuvable</h1>
        <p class="text-gray-600 my-6">La page que vous recherchez a peut-être été supprimée, son nom a changé ou est
            temporairement indisponible.
        </p>
        <x-events.button-gradient href="{{ route('events.index') }}">Retour à la page d'accueil</x-events.button-gradient>
    </div>
</div>
</x-app-layout>