<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomController extends Controller
{
    public function custom_registerPost(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
        ]);

        $customer = new Customer([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);
        $check = $customer->save();
        if ($check) {
            Session::flash('success', 'Registration Successful');
            return view('login');
        }
        Session::flash('error', 'Something is error');
        return view('login');

    }
    public function custom_register()
    {
        return view('register');
    }
    public function custom_loginPost(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $customer = Customer::where('email', $request->email)->first();
        $storedHashedPassword = $customer->password;
        if (Hash::check($request->password, $storedHashedPassword)) {
            $cust = [
                'email' => $request->email,
            ];
            session()->put('user', $cust);
            Session::flash('success', 'Login Successful');
            if (session::has('user'))
                return view('customerinfo', compact('customer'));

            // }
            // $customer = Customer::where('email', $credentials['email'])
            //     ->where('password', $credentials['password'])
            //     ->first();
            // if ($customer !== null && $customer->exists()) {

        }
        Session::flash('error', 'Failed Successfully');
        return view('login');
    }
    public function custom_login()
    {
        return view('login');
    }

}
