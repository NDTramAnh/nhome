@extends('home')

@section('main-content')
  <!-- @if (session('error'))
    <div class="alert alert-danger">
    {{ session('error') }}
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
  @endif -->
  {{-- Main Content --}}

  <div class="d-flex justify-content-between align-items-center mb-2">
    <h5 class="mb-0">Import Orders</h5>
    {{-- Flash Messages --}}
    <!-- @if(session('success'))
    <div id="toast-message" style="
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #4CAF50;
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    font-weight: bold;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease;">
    ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div id="toast-message" style="
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #f44336;
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.2);
    font-weight: bold;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease;">
    ❌ {{ session('error') }}
    </div>
    @endif -->

    <script>
    setTimeout(() => {
      const toast = document.getElementById('toast-message');
      if (toast) {
      toast.style.opacity = '0';
      setTimeout(() => toast.style.display = 'none', 500);
      }
    }, 2000);
    </script>
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

      <form action="{{ route('import.delete', $order->id_import) }}" method="POST" style="display: inline-block;"
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