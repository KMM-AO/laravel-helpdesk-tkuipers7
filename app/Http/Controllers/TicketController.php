<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|max:40',
            'contents' => 'required',
            'category' => 'required|exists:categories,id'
        ]);

        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->contents = $request->contents;
        $ticket->category_id = $request->category;
        $request->user()->created_tickets()->save($ticket);

        return redirect()->route('dashboard')->with('status', 'Ticket is saved');
    }

    public function create()
    {
        return view('pages.ticket.create')->with('categories', Category::all());
    }

    public function index($status)
    {
        $tickets = Ticket::all();
        return view('pages.ticket.index')
            ->with('status' , $status)
            ->with('tickets' ,$tickets);
    }
}
