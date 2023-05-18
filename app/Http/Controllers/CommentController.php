<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Enregistre un commentaire
     */
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'description' => 'required|min:3|max:1000',
        ]);

        $comment = Comment::create([
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
            'event_id' => $event->id,
        ]);

        return redirect()->route('events.show', $event->id)->withSuccess('Votre commentaire a été ajouté !');
    }

    /**
     * Supprime un commentaire
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back()->withSuccess('Le commentaire a été supprimé !');
    }
}
