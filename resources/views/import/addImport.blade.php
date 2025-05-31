@extends('home')

@section('main-content')
  {{-- Main Content --}}
  <h2 class="mb-4">Add Import Order</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>   
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 15px;">
    <form action="{{ route('import.store') }}" method="POST">
      @csrf
      <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

        <div class="form-group d-flex flex-column">
          <label for="supplier"><strong>Nhà cung cấp</strong></label>
          <select id="supplier" name="supplier_id" class="form-control" required>
            <option value="">-- Chọn nhà cung cấp --</option>
            @foreach ($suppliers as $supplier)
              <option value="{{ $supplier->id_supplier }}">{{ $supplier->name_supplier }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="note"><strong>Ghi chú</strong></label>
          <textarea id="note" name="note" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="import_date"><strong>Ngày nhập</strong></label>
          <input type="date" id="import_date" name="import_date" class="form-control" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="user"><strong>Người nhập</strong></label>
         <input type="hidden" name="user_id" value="{{ Auth::id() }}">
<input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
        </div>
      </div>
       <div class="mb-2">
                <label>Người tạo</label>
               
            </div>

      <hr class="my-4">

      <div class="form-group d-flex flex-column">
        <label><strong>Danh sách sản phẩm</strong></label>
        <div id="product-rows">
          <div class="product-row d-flex gap-2 mb-2">
            <select name="product_id[]" class="form-control" required>
              <option value="">-- Chọn sản phẩm --</option>
              @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
              @endforeach
            </select>
            <input type="number" name="import_price[]" class="form-control" placeholder="Giá nhập" required min="0">
            <input type="number" name="quantity[]" class="form-control" placeholder="Số lượng" required min="1">
            <button type="button" class="btn btn-danger remove-row">X</button>
          </div>
        </div>
        <button type="button" id="add-row" class="btn btn-secondary mt-2">+ Thêm sản phẩm</button>
      </div>

      <input type="hidden" name="total_price" id="total_price" value="0">

      <div class="form-row d-flex align-items-center mt-4 justify-content-end">
        <button type="submit" class="btn btn-primary">Thêm</button>
        <a href="{{ route('import.page') }}" class="btn btn-danger ml-2">Quay lại</a>
      </div>
    </form>
  </div>

  <style>
    body {
      overflow-x: hidden;
    }

    .form-control {
      max-width: 100%;
      box-sizing: border-box;
    }

    .product-row select,
    .product-row input {
      flex: 1;
    }

    .product-row .remove-row {
      flex-shrink: 0;
    }
  </style>

  <script>
    document.getElementById('add-row').addEventListener('click', () => {
      const container = document.getElementById('product-rows');
      const newRow = container.firstElementChild.cloneNode(true);
      newRow.querySelectorAll('input').forEach(input => input.value = '');
      container.appendChild(newRow);
    });

    document.getElementById('product-rows').addEventListener('click', (e) => {
      if (e.target.classList.contains('remove-row') && document.querySelectorAll('.product-row').length > 1) {
        e.target.closest('.product-row').remove();
      }
    });
    
  </script>
@endsection
