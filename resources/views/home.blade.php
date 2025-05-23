@extends('dashboard')

@section('content')
<div class="container-fluid px-0">
    <div class="row mx-0">

<style>
    .nav-link.active {
        font-weight: bold;
        color:rgb(3, 21, 71); /* hoặc màu bạn muốn */
        background-color: #ffffff;
        border-radius: 5px;
    }
</style>
<div class="container-fluid p-0">
    <div class="row mx-0">

        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('products.index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}" href="{{ route('import.page') }}">Import_Orders</a>
                </li>  
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}" href="{{ route('export.orders') }}">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers.index') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('thongke') ? 'active' : '' }}" href="{{ route('thongke') }}">Inventory_Report</a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{ route('signout') }}" onclick="return confirm('Bạn có muốn đăng xuất không?')">Log out</a>
                    </li>
            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="col-md-10 p-4 pe-0" style="max-width: 100%; overflow-x: hidden;">
            @hasSection('main-content')
            @yield('main-content')
            @else

                {{-- Main Content --}}
        <div class="col-md-10 p-4">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
            </div>
            @endif
        </div>
            
        </div>

        
    </div>
</div>

{{-- Toast thông báo --}}
@if(session('success') || session('error'))
<div id="custom-toast" class="custom-toast {{ session('error') ? 'error' : 'success' }}">
    {{ session('success') ?? session('error') }}
</div>
@endif

<style>
    .custom-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        font-weight: 500;
        z-index: 9999;
        animation: slideIn 0.5s ease, fadeOut 0.5s ease 3.5s forwards;
    }

    .custom-toast.success {
        background-color: #28a745;
    }

    .custom-toast.error {
        background-color: #dc3545;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(100%);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
            transform: translateY(20px);
        }
    }
</style>

<script>
    setTimeout(() => {
        const toast = document.getElementById('custom-toast');
        if (toast) toast.remove();
    }, 4000);
</script>
@endsection