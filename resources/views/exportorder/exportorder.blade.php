
@extends('home')

@section('main-content')
<h4>Export_Orders</h4>

<div class="d-flex justify-content-between align-items-center mb-3">
   <a href="{{ route('exportorder.create') }}" class="btn btn-primary">+ Add</a>
    <form class="d-flex" method="GET" action="{{ route('export.orders') }}">
        <input class="form-control me-2" type="search" placeholder="Search..." name="search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Mã phiếu</th>
            <th>Khách hàng</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>
            <th>Trị giá</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($exportOrders as $order)
        <tr>
            <td>{{ $order->id_export }}</td>
            <td>{{ $order->id_customer }}</td>
            <td>{{ $order->id_user }}</td>
            <td>{{ \Carbon\Carbon::parse($order->create_at)->format('d/m/Y') }}</td>
            <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>
                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                <a href="#" class="btn btn-primary btn-sm">Print</a>
                <a href="#" class="btn btn-secondary btn-sm">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-center mt-3">
    {{ $exportOrders->links() }}
</div>
@endsection
