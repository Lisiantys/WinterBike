<div class="w-full h-16" style="background: linear-gradient(178deg, white 50%, #10564f 50%);"></div>
<footer class="bg-gradient-to-b from-dark-green to-mint w-full p-4 md:py-8">
    <div class="grid grid-flow-row gap-4 space-y-5 md:space-y-0 items-center justify-items-center text-center md:grid-flow-col md:text-left">
        <x-application-logo class="w-32 h-32"/>
        <div class="text-white max-w-md space-y-4 md:space-y-2">
            <h3 class="font-extrabold text-xl tracking-wider">Winter Bike</h3>
            <p> 
                Participez aux rassemblements de moto pour une série d'événements
                à travers la France. Que ce soit pour une balade apaisante, une exposition 
                innovante, une hivernale revigorante ou un roadtrip captivant, chaque événement 
                est une nouvelle aventure à savourer.
            </p>
        </div>
        
        <ul class="text-base font-medium text-white space-y-4  md:space-y-5 ">
            <li class="space-x-3">
                <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i>
                <a href="{{ route('index') }}" class="hover:underline">Accueil </a>
            </li>
            <li class="space-x-3">
                <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i>
                <a href="mailto:example@example.com" class="hover:underline">Contactez-nous</a>
            </li>
            <li class="space-x-3">
                <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i>
                <a href="{{ route('mentions-legales') }}" class="hover:underline">Mentions Légales</a>
            </li>
            <li class="space-x-3">
                <i class="fa-solid fa-chevron-right" style="color: #ffffff;"></i>
                <a href="{{ route('politique-de-confidentialite') }}" class="hover:underline">Politique de Confidentialité</a>
            </li>
        </ul>
    </div>
    <hr class="my-6 w-full sm:w-1/2 border-white mx-auto lg:my-8" />
    <span class="block text-sm text-white text-center">© 2023 <a href="https://winterbike.fr/" class="hover:underline">Winter Bike</a>. Tous droits réservés.</span>
</footer>

