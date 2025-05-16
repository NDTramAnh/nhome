@extends('dashboard')

@section('content')

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
        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Import_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.list') ? 'active' : '' }}" href="{{ route('user.list') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inventory_Report</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}">Log out</a>
                    </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
            </div>
        </div>
    </div>
</div>
@endsection
