<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10.48.0 - CRUD User Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
    <div class="container">
        <a class="navbar-brand mr-auto" href="#" style="color:rgb(218, 0, 181);"><strong>GoStock</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>


    
</nav>

<div class="container-fluid p-0">
    <div class="row m-0">
        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link active" href="home">Home</a>
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
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="thong-ke">Inventory_Report</a>
                </li>
            </ul>
        </div>

        {{-- Content --}}
        <div class="col-md-9 py-4 px-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
               @yield('content')
            </div>
        </div>
    </div>
</div>
</body>

</html>