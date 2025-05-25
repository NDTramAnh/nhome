@extends('dashboard')

@section('content')


<style>
    body {
        background: url('/images/pexels-sohi-807598.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .login-container {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        max-width: 400px;
        margin: 100px auto;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    .login-container h3 {
        background-color: #a3ddff;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 10px 10px 0 0;
        margin: -30px -30px 20px -30px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.7);
        border: none;
        border-radius: 10px;
        padding: 10px;
        margin-bottom: 15px;
    }

    .btn-login {
        background-color: #a3ddff;
        border: none;
        color: black;
        padding: 10px;
        font-weight: bold;
        border-radius: 20px;
        width: 100%;
    }

    .register-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: red;
        font-size: 0.9em;
    }
</style>

<main class="login-form">
    <div class="login-container">
        <h3>Login</h3>
        @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

        <form method="POST" action="{{ route('users.authUser') }}">
        @if ($errors->has('login'))
    <div class="alert alert-danger text-center" role="alert">
        {{ $errors->first('login') }}
    </div>
@endif    
        @csrf
            <input type="text" placeholder="email" id="email" class="form-control" name="email" required autofocus>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif

            <input type="password" placeholder="password" id="password" class="form-control" name="password" required>
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif

            <button type="submit" class="btn btn-login">Login</button>

            <a href="{{ route('users.createUser') }}" class="register-link">Register</a>
        </form>
    </div>
</main>
@endsection

