@extends('home')

@section('main-content')
    {{-- Main Content --}}

      <div class="d-flex justify-content-between align-items-center mb-2">
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