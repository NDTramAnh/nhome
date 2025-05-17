@extends('dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
           <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}" href="{{ route('import.orders') }}">Import_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}" href="{{ route('export.orders') }}">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inventory.report') ? 'active' : '' }}" href="{{ route('inventory.report') }}">Inventory_Report</a>
                </li>

            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="col-md-10 p-4">
            @hasSection('main-content')
                @yield('main-content')  {{-- Nếu trang con có khai báo section main-content thì hiển thị ở đây --}}
            @else
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
                    <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
