@extends('dashboard')

@section('title', 'Thêm sản phẩm mới')

@section('content')
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-md-6">

      <a href="{{ route('products.index') }}" class="btn btn-link mb-3">← Quay lại danh sách</a>
      
      <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-center">
          <h4 class="mb-0">Thêm sản phẩm mới</h4>
        </div>
        <div class="card-body">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="name_product" class="form-label">Tên sản phẩm</label>
              <input type="text" class="form-control" id="name_product" name="name_product" value="{{ old('name_product') }}" required>
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Danh mục</label>
              <input type="text" class="form-control" id="category" name="category" value="{{ old('category') }}" required>
            </div>

            <div class="mb-3">
              <label for="stock_quantity" class="form-label">Số lượng trong kho</label>
              <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" required min="0">
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Giá tiền (VND)</label>
              <input type="number" class="form-control" step="0.01" id="price" name="price" value="{{ old('price') }}" required min="0">
            </div>

            <div class="mb-4">
              <label for="status" class="form-label">Tình trạng</label>
              <select class="form-select" id="status" name="status" required>
                <option value="" disabled {{ old('status') === null ? 'selected' : '' }}>-- Chọn tình trạng --</option>
                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Còn hàng</option>
                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Hết hàng</option>
                <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Tạm ngưng bán</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm sản phẩm</button>
          </form>
        </div>
      </div>
      
    </div>
  </div>
</div>
@endsection
