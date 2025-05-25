@extends('dashboard')

@section('content')
  <div class="container-fluid p-0">
    <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">

      <ul class="nav flex-column mt-4">
      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
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
        <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
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

    {{-- Main Content --}}
    <div class="col-md-10 p-4">



      {{-- Import Orders Section --}}
      <div class="bg-white p-4 shadow rounded">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Import Orders</h5>
        <a href="{{ route('addImport.page') }}" class="btn btn-success">+ Tạo phiếu nhập</a>

      </div>

      {{-- Search Bar --}}
      <form method="GET" action="{{ route('import.page') }}" class="d-flex mb-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm mã phiếu, người nhập..."
        class="form-control me-2" style="max-width: 250px;">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
      </form>

      {{-- Table --}}
      <table class="table table-bordered">
        <thead class="table-light">
        <tr>
          <th>Mã phiếu</th>
          <th>Ngày nhập</th>
          <th>Người nhập</th>

          <th>Tổng tiền</th>
          <th>Tùy chọn</th>
        </tr>
        </thead>
        <tbody>
        @foreach($importOrders as $order)
      <tr>
        <td>{{ $order->id_import }}</td>
        <td>{{ \Carbon\Carbon::parse($order->import_date)->format('d/m/Y') }}</td>
        <td>{{ $order->user->name ?? '---' }}</td>

        <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
        <td>
        <a href="{{ route('import.show', $order->id_import) }}" class="btn btn-sm btn-info">Xem</a>

        <form action="{{ route('import.delete', $order->id_import) }}" method="POST"
        style="display: inline-block;"
        onsubmit="return confirm('Bạn có chắc chắn muốn xóa phiếu nhập này không?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
        </form>
        </td>
      </tr>
      @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {{ $importOrders->appends(request()->input())->links() }}
      </div>

      </div>
    </div>
    </div>
  </div>
@endsection