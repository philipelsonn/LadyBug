<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        if (auth()->user()->type == 'USER'){
            
            return view('dashboards.user');

        } else if (auth()->user()->type == 'STAFF'){

            return view('dashboards.staff');

        } else{

            return view('dashboards.admin');
        }
    }
}
