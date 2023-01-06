<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function index(){
        redirect()->route('auth.login');
    }

    public function login(){
        return view('auth.login');
    }

    public function loginAuth(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('failed', 'Login Failed!');
    }

    public function register(){
        return view('auth.register');
    }

    public function registerAuth(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'min:6|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'min:6'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('auth.login')->with('success', 'Registration Success! Please Login!');
    }

}
