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
        $user = auth()->user();

        if ($user->id === $comment->user_id || $user->id === 3 || $user->id === 4) {
            $comment->delete();

            return redirect()->back()->with('success', 'Le commentaire a été supprimé.');
        }

        return redirect()->back()->with('error', "Vous n'êtes pas autorisé à supprimer ce commentaire.");
    }
}
