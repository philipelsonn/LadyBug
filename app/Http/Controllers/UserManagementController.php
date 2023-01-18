<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    public function manageUser(){
        $users = DB::table('users')->where('type', 'STAFF')->orWhere('type', 'USER')->get();
        $data = [
            'users' => $users
        ];
        return view('management.index', $data);
    }

    public function viewUpdate(int $id){
        $user = DB::table('users')->where('id', $id)->first();

        $data = [
            'user' => $user
        ];

        return view('management.update', $data);
    }

    public function updateUser(Request $request, int $id){
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns',
            'password' => 'min:6|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'min:6',
        ]);

        $user = User::where('id', $id)->first();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('management.index');
    }

    public function deleteUser(int $id){
        $user = User::where('id', '=', $id)->delete();

        return redirect()->route('management.index');
    }
}
