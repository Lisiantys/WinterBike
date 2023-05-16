@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Bouton Précédent --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" style="color:grey;"><span>Précédent</span></li>
        @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">Précédent</a></li>
        @endif

        {{-- Bouton Suivant --}}
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">Suivant</a></li>
        @else
            <li class="disabled" style="color:grey;"><span>Suivant</span></li>
        @endif
    </ul>
@endif
