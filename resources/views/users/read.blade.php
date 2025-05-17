@extends('dashboard')

@section('content')
    <main class="login-form my-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="mb-4">Thông tin người dùng</h3>
                    <div class="card shadow-sm rounded-3">
                        <div class="card-body">
                            <table class="table table-bordered table-hover table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                        <a href="{{ route('user.role', ['id' => $role->id]) }}">
                                            <span class="badge bg-info text-dark">
                                                {{ $role->name . '-' }}
                                            </span>
                                        </a>
                                    @endforeach
                                        </td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center mt-4">
                        <a href="{{ route('user.list') }}" class="btn btn-secondary">
                            ← Quay lại danh sách người dùng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
