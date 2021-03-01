<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
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

    public function index(Request $request,$status)
    {
        $user = $request->user();

        switch ($status) {
            case 'open':
                switch ($user->role_id) {
                    case Role::BOSS:
                    case Role::EMPLOYEE:
                        // query 1
                        $tickets = Ticket::all();
                        break;
                    case Role::CUSTOMER:
                        // query 3
                        $tickets = $user->created_tickets();
                        break;

                }
                break;
            case 'waiting':
                switch ($user->role_id) {
                    case Role::BOSS:
                    case Role::EMPLOYEE:
                        // query 8
                        $tickets = Ticket::doesnthave('processing_users')->get();
                        break;
                    case Role::CUSTOMER:
                        // query 10
                        $tickets = $user->created_tickets()->doesnthave('processing_users')->get();
                        break;
                }
                break;
            case 'processed':
                switch ($user->role_id) {
                    case Role::BOSS:
                        // query 7
                        $tickets = Ticket::has('processing_users')->get();
                        break;
                    case Role::EMPLOYEE:
                        // query 5
                        $tickets = $user->processed_tickets()->get();
                        break;
                    case Role::CUSTOMER:
                        // query 9
                        $tickets = $user->created_tickets()->has('processing_users')->get();
                        break;
                }
                break;
            case 'closed':
                switch ($user->role_id) {
                    case Role::BOSS:
                        // query 2
                        $tickets = Ticket::onlyTrashed()->get();
                        break;
                    case Role::EMPLOYEE:
                        // query 6
                        $tickets = $user->processed_tickets()->onlyTrashed()->get();
                        break;
                    case Role::CUSTOMER:
                        // query 4
                        $tickets = $user->created_tickets()->onlyTrashed()->get();
                        break;
                }
                break;
        }

        return view('pages.ticket.index')
            ->with('status' , $status)
            ->with('tickets' ,$tickets);
    }
}
