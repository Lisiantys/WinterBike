<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventFavorites extends Component
{
    public $event;
    public $rank;
    /**
     * Create a new component instance.
     */
    public function __construct($event, $rank)
    {
        $this->event = $event;
        $this->rank = $rank;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-favorites');
    }
}
