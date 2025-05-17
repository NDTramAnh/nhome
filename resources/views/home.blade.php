@extends('dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
<<<<<<< HEAD
                <a class="nav-link" href="{{ route('products.index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Import_Orders</a>
=======
                    <a class="nav-link" href="">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('import.page') }}">Import_Orders</a>
>>>>>>> e2a497866853346a56073bd70bcec8cb42b9f88d
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inventory_Report</a>
                </li>
            </ul>
        </div>

        {{-- Content --}}
         <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
            </div>
        </div> 
    </div>
</div>
@endsection
