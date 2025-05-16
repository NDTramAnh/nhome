@extends('dashboard')

@section('content')
    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            <td>{{$user->email}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
