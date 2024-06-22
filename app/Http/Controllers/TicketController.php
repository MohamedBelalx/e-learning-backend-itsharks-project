<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show all tickets
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    // Show the form for creating a new ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Store a new ticket
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $ticket = new Ticket($request->all());
        $ticket->user_id = auth()->id();  // assuming the user is logged in
        $ticket->save();

        return redirect()->route('tickets.index');
    }

    // Show a specific ticket
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    // Show the form for editing a specific ticket
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    // Update a specific ticket
    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'description' => 'required',
        ]);

        $ticket->update($request->all());
        return redirect()->route('tickets.index');
    }

    // Delete a specific ticket
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->route('tickets.index');
    }
}
