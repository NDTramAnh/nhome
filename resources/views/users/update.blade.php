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
    <main class="signup-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Update User</h3>
                        <div class="card-body">
                            <form action="{{ route('users.postUpdateUser', ['id' => $user->id]) }}" method="POST">

                                @csrf
                                <input name="id" type="hidden" value="{{$user->id}}">
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" id="name" class="form-control" name="name"
                                           value="{{ $user->name }}"
                                           required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Email" id="email_address" class="form-control"
                                           value="{{ $user->email }}"
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
                                <div class="form-group mb-3">
    <input type="password" placeholder="Confirm Password" id="password_confirmation" class="form-control"
           name="password_confirmation" required>
    @if ($errors->has('password_confirmation'))
        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
    @endif
</div>

                                <div class="form-group mb-3">
    <label><strong>Roles:</strong></label><br>
    @foreach($roles as $role)
        <div class="form-check form-check-inline">
            <input type="checkbox" class="form-check-input" name="roles[]" id="role_{{ $role->id }}" value="{{ $role->id }}"
                {{ in_array($role->id, $userRoles) ? 'checked' : '' }}>
            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
        </div>
    @endforeach
    @if ($errors->has('roles'))
        <div class="text-danger">{{ $errors->first('roles') }}</div>
    @endif
</div>

                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection