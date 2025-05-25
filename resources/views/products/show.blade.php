@extends('dashboard')

@section('title', 'Chi tiết sản phẩm')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <h2 class="text-center mb-4" style="color: #6a1b9a; font-style: italic;">Chi tiết sản phẩm</h2>

      <div class="card shadow-sm">
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Tên sản phẩm:</label>
            <div>{{ $product->name_product }}</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Danh mục:</label>
            <div>{{ $product->category }}</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Số lượng trong kho:</label>
            <div>{{ $product->stock_quantity }}</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Giá tiền:</label>
            <div>{{ number_format($product->price, 0, ',', '.') }} VND</div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Tình trạng:</label>
            <div>
              @if($product->status == '1')
                Còn hàng
              @elseif($product->status == '0')
                Hết hàng
              @elseif($product->status == '2')
                Tạm ngưng bán
              @else
                Không xác định
              @endif
            </div>
          </div>

          <a href="{{ route('products.index') }}" class="btn btn-link mt-3">← Quay lại danh sách sản phẩm</a>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
