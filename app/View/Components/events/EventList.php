<?php

namespace App\View\Components\events;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventList extends Component
{
    public $event;
    /**
     * Create a new component instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-list');
    }
}
