@extends('home')

@section('main-content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<style>
    .nav-link.active {
        font-weight: bold;
        color: #0d6efd; /* hoặc màu bạn muốn */
        background-color: #ffffff;
        border-radius: 5px;
    }
</style>

<div class="container-fluid p-0">
    <div class="row">
    
    <form method="GET" action="{{ route('users.list') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm username hoặc email..." value="{{ request()->get('keyword') }}">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
</form>

        {{-- Main Content --}}
        <div class="col-md-10 p-4">
            <h5 class="danhSach">Danh sách user</h5>

            @if (Session::has('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::has('error'))
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-circle"></i> {{ Session::get('error') }}
    </div>
@endif


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td style="text-align: center;">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                    @foreach($user->roles as $role)
                                        <a href="{{ route('users.role', ['id' => $role->id]) }}">
                                            <span class="badge bg-info text-dark">
                                                {{ $role->name . '-' }}
                                            </span>
                                        </a>
                                    @endforeach
                                </td>
                            <td>
                                <a href="{{ route('users.readUser', ['id' => $user->id]) }}" class="btn btn-info btn-sm">View</a> |
                                <a href="{{ route('users.updateUser', ['id' => $user->id]) }}" class="btn btn-warning btn-sm">Edit</a> |
                                <a href="{{ route('users.deleteUser', ['id' => $user->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn xoá không?')">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
    {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
        
    </div>
</div>
@endsection
