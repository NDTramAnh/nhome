<!DOCTYPE html>
<html>
<head>
    <title>Print Export Order</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        h2 { text-align: center; }
        .print-btn { display: none; }
    </style>
</head>
<body onload="window.print()">

    <h2>PHIẾU XUẤT KHO</h2>
    <p><strong>Mã phiếu:</strong> {{ $order->id }}</p>
    <p><strong>Khách hàng:</strong> {{ $order->id_customer }}</p>
    <p><strong>Người tạo:</strong> {{ $order->user->name ?? 'N/A' }}</p>
    <p><strong>Ngày tạo:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->details as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price, 0, ',', '.') }}</td>
                <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Tổng cộng:</strong> {{ number_format($order->total_price, 0, ',', '.') }} VNĐ</p>

</body>
</html>
