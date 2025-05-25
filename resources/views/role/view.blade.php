@extends('dashboard')

@section('content')
    <main class="login-form mt-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h4 class="mb-3">Role Details</h4>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <div class="container mt-5">
        <h4 class="mb-3">List of Users with Role: <strong>{{ $role->name }}</strong></h4>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table table-hover table-bordered">
                    <thead class="table-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($role->users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No users assigned to this role.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <!-- Back Button -->
    <div class="container mt-4 mb-5 text-center">
        <a href="{{ route('user.list') }}" class="btn btn-secondary">
            ← Quay lại danh sách người dùng
        </a>
    </div>


@endsection
