<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    public function index()
    {
        return view('tickets.index', [
            'tickets' => Ticket::all(),
        ]);
    }

    // public function create($id)
    // {

    //     return view('tickets.create', [
    //         'staffs' => User::where('type', $type)->get(),
    //         'submission' => Submission::where('id', $id)->get()->first()
    //     ]);
    // }

    public function store(Request $request, $id)
    {   
        $request->validate([
            'user_id' => 'required|integer',
            'priority' => 'required|string',
        ]);

        $submission = Submission::where('id', $id)->get()->first();

        Ticket::create([
            'submission_id' => $submission->id,
            'user_id' => $request->user_id,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tickets.index');
    }

    // public function edit($id)
    // {
    //     return view('tickets.edit', [
    //         'ticket' => Ticket::where('id', $id)->get()->first(),
    //     ]);
    // }

    // public function update(Request $request, Ticket $ticket)
    // {
    //     $request->validate([
    //         'status' => 'required|string',
    //     ]);

    //     $ticket->update([
    //         'status' => $request->status,
    //     ]);

    //     return redirect()->route('tickets.index');
    // }
    
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
