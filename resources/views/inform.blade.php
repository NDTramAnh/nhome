@extends('dashboard')

@section('content')
<div class="container-fluid p-4" style="background-color: #e6f0ff; min-height: 100vh;">
  <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
        <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}" href="{{ route('import.orders') }}">Import_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}" href="{{ route('export.orders') }}">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('thongke') ? 'active' : '' }}" href="{{ route('thongke') }}">Inventory_Report</a>
                </li>
                
            </ul>
    </div>

    {{-- Main Content --}}
    <div class="col-md-10">
      <div class="container bg-white p-4 shadow-sm" style="max-width: 950px; margin: auto;">
        <h2 class="mb-4">Thông tin phiếu nhập</h2>

        {{-- Thông tin chung --}}
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group d-flex flex-column">
            <label><strong>Nhà cung cấp</strong></label>
            <input type="text" class="form-control" value="{{ $order->supplier->name_supplier ?? '---' }}" readonly>
          </div>

          <div class="form-group d-flex flex-column">
            <label><strong>Ngày nhập</strong></label>
            <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($order->import_date)->format('d/m/Y') }}" readonly>
          </div>

          <div class="form-group d-flex flex-column">
            <label><strong>Người nhập</strong></label>
            <input type="text" class="form-control" value="{{ $order->user->name ?? '---' }}" readonly>
          </div>

          <div class="form-group d-flex flex-column">
            <label><strong>Ghi chú</strong></label>
            <textarea class="form-control" readonly>{{ $order->note ?? '' }}</textarea>
          </div>
        </div>

        {{-- Danh sách sản phẩm --}}
        <table class="table table-bordered mt-4">
          <thead class="table-light">
            <tr>
              <th>STT</th>
              <th>Tên hàng</th>
              <th>Số lượng</th>
              <th>Đơn giá</th>
              <th>Tổng tiền</th>
            </tr>
          </thead>
          <tbody>
            @foreach($order->details as $index => $detail)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $detail->product->name_product ?? '---' }}</td>
              <td>{{ $detail->quantity }}</td>
              <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
              <td>{{ number_format($detail->price * $detail->quantity, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
          </tbody>
        </table>

        {{-- Tổng tiền --}}
        <div class="text-end mt-2">
          <strong>Tổng cộng: {{ number_format($order->total_price, 0, ',', '.') }}đ</strong>
        </div>

        {{-- Nút hành động --}}
        <div class="d-flex justify-content-between mt-4">
          <button class="btn btn-outline-primary">Xuất phiếu</button>
          <a href="{{ route('import.page') }}" class="btn btn-danger">Quay lại</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
