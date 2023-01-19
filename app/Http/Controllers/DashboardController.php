<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Submission;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    public function editProfile(){
        return view('profile.edit');
    }

    public function edit(Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'password' => 'min:6|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'min:6',
            'image_new' => 'image|nullable|mimes:jpg,png,jpeg'
        ]);

        $userId = auth()->user()->id;
        $user = User::where('id', $userId);

        if ($request->hasFile('image_new')) {
            $extension = $request->file('image_new')->getClientOriginalExtension();
            $file_name = auth()->user()->id . time() . '.' . $extension;
            $path = $request->file('image_new')->storeAs('public/images/submissions', $file_name);
        } else {
            $file_name = request('image_old');
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_name
        ]);

        return redirect()->route('dashboard');
    }
}
