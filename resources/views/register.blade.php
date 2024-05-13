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
