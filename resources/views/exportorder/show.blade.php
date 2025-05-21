@extends('home')

@section('main-content')
<h4>Chi tiết phiếu xuất #{{ $order->id }}</h4>

<div>
    <p><strong>Khách hàng:</strong> {{ $order->customer->name ?? $order->id_customer }}</p>
    <p><strong>Người tạo:</strong> {{ $order->user->name ?? $order->id_user }}</p>
    <p><strong>Ngày tạo:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>
    <p><strong>Trị giá:</strong> {{ number_format($order->total_price, 0, ',', '.') }}</p>
</div>

<h5>Chi tiết các mặt hàng xuất</h5>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order->orderDetails as $detail)
        <tr>
            <td>{{ $detail->product->name ?? 'Không có tên sản phẩm' }}</td>
            <td>{{ $detail->quantity }}</td>
            <td>{{ number_format($detail->price, 0, ',', '.') }}</td>
            <td>{{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('export.orders') }}" class="btn btn-secondary">Quay lại</a>
@endsection
