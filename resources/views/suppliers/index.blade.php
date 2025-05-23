@extends('home')

@section('main-content')

<div class="fluit">
    <h4><strong>Danh sách nhà cung cấp</strong></h4>
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
@endsection