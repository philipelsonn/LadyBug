<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Submission;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        if (auth()->user()->type == 'USER'){
            
            $id = Submission::where('submitted_by', auth()->user()->id)->pluck('id');
            return view('dashboards.user', [
                'submissions' => Submission::where('submitted_by', auth()->user()->id)->get(),
                'tickets' => Ticket::whereIn('submission_id', $id)->get()
            ]);

        } elseif (auth()->user()->type == 'STAFF'){

            $id = auth()->user()->id;
        
            return view('dashboards.staff', [
                'tickets' => Ticket::where('user_id', $id)->get(),
            ]);

        } elseif (auth()->user()->type == 'ADMIN'){

            $type = "STAFF";

            return view('dashboards.admin', [
                'submissions' => Submission::all(),
                'tickets' => Ticket::all(),
                'staffs' => User::where('type', $type)->get(),
            ]);
        }
    }
}
