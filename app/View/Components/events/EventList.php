<?php

namespace App\View\Components\events;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventList extends Component
{
    public $event;
    public $isFavoriteView;
    public $isTopFavorite;

    /**
     * Create a new component instance.
     */
    public function __construct($event, $isFavoriteView = false, $isTopFavorite = false)
    {
        $this->event = $event;
        $this->isFavoriteView = $isFavoriteView;
        $this->isTopFavorite = $isTopFavorite;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-list', [
            'isFavoriteView' => $this->isFavoriteView,
            'isTopFavorite' => $this->isTopFavorite,
        ]);
    }
}
