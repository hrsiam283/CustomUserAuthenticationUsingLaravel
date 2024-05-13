## creating model with migration table

```php
php artisan make:model Customer -m
```

## use this in Customer.php

```php
 protected $fillable = [
        'name',
        'email',
        'password',
    ];
```

## customers table

```php
 public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }
```

## web.php

// routes for custom authentications

```php
Route::get('/custom_register', [CustomController::class, 'custom_register'])->name('custom_register.view');
Route::post('/custom_register', [CustomController::class, 'custom_registerPost'])->name('custom_registerPost');
Route::get('/custom_login', [CustomController::class, 'custom_login'])->name('custom_login.view');
Route::post('/custom_login', [CustomController::class, 'custom_loginPost'])->name('custom_loginPost');
```

## master.blade.php

```php
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #17a2b8 !important;
        }

        .jumbotron {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-info">
        <a class="navbar-brand" href="#">Your Brand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">SignIn/up <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
```

## register.blade.php

```php
@extends('master')
@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Register</h2>
        <form action="{{ route('custom_registerPost') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="John Doe" required>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="john@example.com" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="password" required>
            </div>
            <div class="form-group">
                <label for="father_name">Father's Name</label>
                <input type="text" class="form-control" id="father_name" name="father_name" value="John's Father"
                    required>
            </div>
            <div class="form-group">
                <label for="mother_name">Mother's Name</label>
                <input type="text" class="form-control" id="mother_name" name="mother_name" value="John's Mother"
                    required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

    </div>
@endsection
```

## login.blade.php

```php
@extends('master')
@section('content')
    <h1>Login Form</h1>
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::has('error'))
        <div class="alert alert-success">{{ Session::get('error') }}</div>
    @endif
    <form action="{{ route('custom_loginPost') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
@endsection

```

## CustomController

```php
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
```
