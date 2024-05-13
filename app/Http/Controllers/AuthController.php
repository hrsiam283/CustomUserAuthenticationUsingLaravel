<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
        ]);

        // Create a new User instance with the validated data
        $user = new User([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']), // Hash the password
            'father_name' => $validatedData['father_name'],
            'mother_name' => $validatedData['mother_name'],
        ]);

        $sohellll = $user->save();
        if ($sohellll) {
            Session::flash('msg', 'Successfull');
            return view('home');
        }
        return view('/');
    }
    public function register()
    {
        return view('register');
    }
    public function check_login(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            Session::flash('msg', 'Logged in');
            return view('home');
        }

        // Authentication failed, redirect back with errors
        Session::flash('msg', 'Failed Successfully');

        return view('home');

    }
    public function login()
    {
        return view('login');
    }

}
