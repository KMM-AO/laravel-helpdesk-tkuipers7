<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    //

    public function store()
    {
        return 'dit is de ticket store-request.';
    }

    public function create()
    {
        return view('pages.ticket.create');
    }
}
