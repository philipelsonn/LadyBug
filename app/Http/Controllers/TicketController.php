<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyAdmin;
use App\Mail\NotifyStaff;
use App\Mail\NotifyUser;
use Illuminate\Foundation\Auth\User as AuthUser;

class TicketController extends Controller
{
    public function index()
    {
        $id = auth()->user()->id;
        
        return view('tickets.index', [
            'tickets' => Ticket::where('user_id', $id)->get(),
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
        
        $staff = User::where('user_id', $id)->get()->first();
        $mail = $staff->email;

        Mail::to($mail)->send(new NotifyStaff());

        return redirect()->route('tickets.index');
    }

     public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $ticket = Ticket::where('id', $id)->get()->first();

        $ticket->update([
            'status' => $request->status,
        ]);

        if($request->status == "Resolved"){
            $mail = $ticket->submission->user->email;
            Mail::to($mail)->send(new NotifyUser());
        } elseif ($request->statis == "In Review"){
            $type = "ADMIN";
            $admin = User::where('type', $type)->get()->first();
            $mail = $admin->email;
            Mail::to($mail)->send(new NotifyAdmin());
        }


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
