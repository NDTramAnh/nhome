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
                    <a class="nav-link" href="{{ route('products.index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Import_Orders</a>
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

        {{-- Nội dung chính --}}
        <div class="col-md-10 px-4 py-3">
            <h2 class="mb-4 text-center">Danh sách sản phẩm</h2>

           <div class="row mb-3">
    <!-- Thanh tìm kiếm -->
    <div class="col-md-6 d-flex">
        <form action="{{ route('products.index') }}" method="GET" class="d-flex w-100">
            <input type="text" name="search" class="form-control me-2" placeholder="Tìm mã hoặc tên sản phẩm" value="{{ request('search') }}">
            <button class="btn btn-primary">Tìm</button>
        </form>
    </div>

    <!-- Nút thêm và in -->
    <div class="col-md-6 d-flex justify-content-end">
        <a href="{{ route('products.create') }}" class="btn btn-success me-2">+ Thêm sản phẩm</a>
        <button onclick="window.print()" class="btn btn-outline-info">In danh sách</button>
    </div>
</div>

            <table class="table table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Mã SP</th>
                        <th>Tên SP</th>
                        <th>Mô tả</th>
                        <th>Tình trạng</th>
                        <th>Giá</th>
                        <th>Người tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->name_product }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->status }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }} VND</td>
                            <td>{{ $product->user->name ?? 'Không rõ' }}</td>
                            <td class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('products.edit', $product->id_product) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <a href="{{ route('products.show', $product->id_product) }}" class="btn btn-sm btn-info text-white">Chi tiết</a>
                                <form method="POST" action="{{ route('products.destroy', $product->id_product) }}" onsubmit="return confirm('Xoá sản phẩm {{ $product->name_product }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Xoá</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">Không có sản phẩm nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
