@extends('dashboard')

@section('content')
<div class="container-fluid p-0">
    <div class="row">
        {{-- Sidebar --}}
        <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('import.page') }}">Import_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('suppliers.index') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Inventory_Report</a>
                </li>
            </ul>
        </div>

        {{-- Content --}}
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4><strong>Danh sách nhà cung cấp</strong></h4>
                
            </div>

            {{-- Table --}}
            <div class="table-responsive bg-white p-3 shadow-sm rounded">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Địa chỉ</th>
                            <th>Ngày tạo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suppliers as $supplier)
                            <tr>
                                <td>{{ $supplier->id_supplier }}</td>
                                <td>{{ $supplier->name_supplier }}</td>
                                <td>{{ $supplier->phone_supplier }}</td>
                                <td>{{ $supplier->email }}</td>
                                <td>{{ $supplier->address }}</td>
                                <td>{{ \Carbon\Carbon::parse($supplier->create_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Không có nhà cung cấp nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
