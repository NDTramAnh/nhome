@extends('dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        @if(session('success'))
        <div id="toast-message" style="
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background-color: #4caf50;
                    color: white;
                    padding: 15px 25px;
                    border-radius: 8px;
                    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
                    font-weight: bold;
                    z-index: 9999;
                    opacity: 1;
                    transition: opacity 0.5s ease;">
            ✅ {{ session('success') }}
        </div>

        <script>
            setTimeout(() => {
                const toast = document.getElementById('toast-message');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.style.display = 'none', 500);
                }
            }, 2000);
        </script>
        @endif

        {{-- CSS in ẩn các thành phần không cần thiết --}}
        <style>
            @media print {
                body {
                    margin: 0;
                    padding: 0;
                    font-size: 13px;
                }

                .no-print,
                .sidebar,
                #toast-message,
                .row.mb-3,
                form,
                button,
                .btn,
                .nav {
                    display: none !important;
                }

                .col-md-10 {
                    width: 100% !important;
                }

                .table th,
                .table td {
                    padding: 6px 12px !important;
                }

                .table {
                    font-size: 13px;
                }

                h2 {
                    margin-top: 0;
                }
            }
        </style>

        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar no-print" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                        href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}"
                        href="{{ route('products.index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}"
                        href="{{ route('import.page') }}">Import_Orders</a>

                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}"
                        href="{{ route('export.orders') }}">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}"
                        href="{{ route('users') }}">Users</a>
                </li>
                <li class="nav-item">

                    <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}"
                        href="{{ route('suppliers.index') }}">Suppliers</a>



                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('thongke') ? 'active' : '' }}"
                        href="{{ route('thongke') }}">Inventory_Report</a>
                </li>
            </ul>
        </div>

        {{-- Nội dung chính --}}
        <div class="col-md-10 px-4 py-3">
            <h2 class="mb-4 text-center">Danh sách sản phẩm</h2>

            <div class="row mb-3 no-print">
                <div class="col-md-6 d-flex">
                    <form action="{{ route('products.index') }}" method="GET" class="d-flex w-100">
                        <input type="text" name="search" class="form-control me-2" placeholder="Tìm tên sản phẩm"
                            value="{{ request('search') }}">
                        <button class="btn btn-primary">Tìm</button>
                    </form>
                </div>

                <div class="col-md-6 d-flex justify-content-end">
                    <a href="{{ route('products.create') }}" class="btn btn-success me-2">+ Thêm sản phẩm</a>
                    <button onclick="window.print()" class="btn btn-outline-info">In danh sách</button>
                </div>
            </div>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên SP</th>
                        <th>Danh mục</th>
                        <th>Số lượng tồn</th>
                        <th>Tình trạng</th>
                        <th>Giá</th>
                        <th>Ngày tạo</th>
                        <th>Ngày cập nhật</th>
                        <th class="no-print">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>
                            @if ($product->status == 1)
                            Còn hàng
                            @elseif ($product->status == 0)
                            Hết hàng
                            @elseif ($product->status == 2)
                            Tạm ngưng bán
                            @else
                            Không xác định
                            @endif
                        </td>
                        <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                        <td>{{ $product->created_at ? \Carbon\Carbon::parse($product->created_at)->format('d/m/Y') : '' }}
                        </td>
                        <td>{{ $product->updated_at ? \Carbon\Carbon::parse($product->updated_at)->format('d/m/Y') : '' }}
                        </td>
                        <td class="d-flex gap-1 justify-content-center no-print">
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-sm btn-warning">Sửa</a>
                            <a href="{{ route('products.show', $product->id) }}"
                                class="btn btn-sm btn-info text-white">Chi tiết</a>
                            <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                onsubmit="return confirm('Xoá sản phẩm {{ $product->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Xoá</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-muted">Không có sản phẩm nào.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection