@extends('dashboard')

@section('content')

    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Create User</h3>
                        <div class="card-body">
                            <form action="{{ route('users.postUser') }}" method="POST">
                                @csrf
                                <!-- Đổi name="name" thành name="name_user" -->
                                <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                    required autofocus>
                                @if ($errors->has('name_user'))
                                    <span class="text-danger">{{ $errors->first('name_user') }}</span>
                                @endif
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                                        name="email" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="form-control"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<style>
    body {
        background: url('/images/pexels-sohi-807598.jpg') no-repeat center center fixed;
        background-size: cover;
        font-family: Arial, sans-serif;
    }

    .register-container {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        max-width: 400px;
        margin: 100px auto;
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }

    .register-container h3 {
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

    .btn-register {
        background-color: #a3ddff;
        border: none;
        color: black;
        padding: 10px;
        font-weight: bold;
        border-radius: 20px;
        width: 100%;
    }

    .login-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        color: red;
        text-decoration: none;
    }

    .login-link:hover {
        text-decoration: underline;
    }
</style>

<main class="signup-form">
    <div class="register-container">
        <h3>Create User</h3>
        <form action="{{ route('user.postUser') }}" method="POST">
    @csrf

    <!-- Name -->
    <input type="text" placeholder="Name" id="name" class="form-control" name="name" required autofocus>
    @if ($errors->has('name'))
        <span class="text-danger">{{ $errors->first('name') }}</span>
    @endif

    <!-- Email -->
    <input type="text" placeholder="Email" id="email_address" class="form-control" name="email" required>
    @if ($errors->has('email'))
        <span class="text-danger">{{ $errors->first('email') }}</span>
    @endif

    <!-- Password -->
    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
    @if ($errors->has('password'))
        <span class="text-danger">{{ $errors->first('password') }}</span>
    @endif

    <!-- Confirm Password -->
    <input type="password" placeholder="Confirm Password" id="password_confirmation" class="form-control" name="password_confirmation" required>
    @if ($errors->has('password_confirmation'))
        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
    @endif

    <button type="submit" class="btn btn-register">Register</button>

    <a href="{{ route('login') }}" class="login-link">Đã có tài khoản? Quay lại login</a>
</form>

    </div>
</main>
@endsection

