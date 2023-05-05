<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
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

        return redirect()->route('events.show', $event->id)->with('success', 'Votre commentaire a été ajouté.');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back()->with('success', 'Le commentaire a été supprimé.');
    }
}
