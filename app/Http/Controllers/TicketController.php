<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function create()
    {
        return view('create-ticket');
    }

    public function store(Request $request)
    {
        // Logic to store the ticket data
        // For example: Ticket::create($request->all());
        return redirect()->route('create-ticket')->with('success', 'Ticket created successfully.');
    }
}