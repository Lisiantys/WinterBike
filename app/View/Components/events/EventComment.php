<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EventComment extends Component
{

    public $comment;
    public $isProfilComment;
    /**
     * Create a new component instance.
     */
    public function __construct(Comment $comment, $isProfilComment = false)
    {
        $this->comment = $comment;
        $this->isProfilComment = $isProfilComment;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.events.event-comment', [
            'isProfilComment' => $this->isProfilComment,
        ]);
    }
}
