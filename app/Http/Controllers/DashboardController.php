<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $data = [
            'user' => $user
        ];

        if (auth()->user()->type == 'USER'){
            return view('dashboards.user', $data);
        } else if (auth()->user()->type == 'STAFF'){
            return view('dashboards.staff', $data);
        } else{
            return view('dashboards.admin', $data);
        }
    }
}
