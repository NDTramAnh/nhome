<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Xem trước phiếu nhập</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">PHIẾU NHẬP KHO</h2>

    <p><strong>Nhà cung cấp:</strong> {{ $order->supplier->name_supplier }}</p>
    <p><strong>Ngày nhập:</strong> {{ \Carbon\Carbon::parse($order->import_date)->format('d/m/Y') }}</p>
    <p><strong>Người nhập:</strong> {{ $order->user->name }}</p>
    <p><strong>Ghi chú:</strong> {{ $order->note }}</p>

    <table>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên hàng</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $index => $detail)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: right; margin-top: 10px;"><strong>Tổng cộng:</strong> {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
</body>
</html>
