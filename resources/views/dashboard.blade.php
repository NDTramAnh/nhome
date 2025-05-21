<!-- resources/views/dashboard.blade.php -->

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
        </div>
    </nav>

    <div class="container-fluid p-0">
        <div class="row m-0">
            {{-- Sidebar --}}
            <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
                <ul class="nav flex-column mt-4">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}" href="{{ route('import.orders') }}">Import_Orders</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}" href="{{ route('export.orders') }}">Export_Orders</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers') }}">Suppliers</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('inventory.report') ? 'active' : '' }}" href="{{ route('inventory.report') }}">Inventory_Report</a></li>
                </ul>
            </div>

            {{-- Nội dung chính --}}
            <div class="col-md-10 p-4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Thông báo --}}
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
        setTimeout(function() {
            const toast = document.getElementById('custom-toast');
            if (toast) {
                toast.remove();
            }
        }, 4000);
    </script>

</body>

</html>