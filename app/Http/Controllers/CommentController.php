<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Ticket;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request,Ticket $ticket)
    {
        $request->validate([
            'contents' => 'required'
        ]);

        $comment = new Comment();
        $comment->contents = $request->contents;
        $comment->ticket()->associate($ticket);
        $request->user()->comments()->save($comment);

        return back()->with('status', 'comment is saved');
    }
}
