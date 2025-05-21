@extends('dashboard')

@section('content')
  <div class="container-fluid p-4" style="background-color: #e6f0ff; min-height: 100vh;">
    <div class="row">
    {{-- Sidebar --}}
    <div class="col-md-2 text-center sidebar" style="min-height: 100vh; background-color: #d8edfd;">
      <ul class="nav flex-column mt-4">
      <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Product</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('import.page') }}">Import_Orders</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Export_Orders</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Suppliers</a></li>
      <li class="nav-item"><a class="nav-link" href="#">Inventory_Report</a></li>
      </ul>
    </div>

    {{-- Main Content --}}
    <div class="col-md-10">
      <div class="container bg-white p-4 shadow-sm" style="max-width: 950px; margin: auto;">
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

      <form action="{{ route('import.store') }}" method="POST">
        @csrf
        <div class="form-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">

        <div class="form-group d-flex flex-column">
          <label for="product"><strong>Tên hàng</strong></label>
          <select id="product" name="product_id" class="form-control" required>
          <option value="">-- Chọn sản phẩm --</option>
          @foreach ($products as $product)
        <option value="{{ $product->id_product }}">{{ $product->name_product }}</option>
      @endforeach
          </select>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="price"><strong>Đơn giá</strong></label>
          <input type="number" id="price" name="price" class="form-control" readonly>
        </div>

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
          <label for="quantity"><strong>Số lượng</strong></label>
          <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" required>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="import_date"><strong>Ngày nhập</strong></label>
          <input type="date" id="import_date" name="import_date" class="form-control" value="{{ date('Y-m-d') }}"
          required>
        </div>

        <div class="form-group d-flex flex-column">
          <label for="user"><strong>Người nhập</strong></label>
          <select id="user" name="user_id" class="form-control" required>
          <option value="">-- Chọn người nhập --</option>
          @foreach ($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
      @endforeach
          </select>
        </div>
        </div>

        <input type="hidden" name="total_price" id="total_price" value="0">

        <div class="form-row d-flex align-items-center mt-4 justify-content-end">
        <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
      </form>

     

      </div>
    </div>
    </div>
  </div>

  <script>
    
    const products = @json($products);
    const productSelect = document.getElementById('product');
    const priceInput = document.getElementById('price');
    const quantityInput = document.getElementById('quantity');
    const totalPriceInput = document.getElementById('total_price');

    function updatePrice() {
    const productId = productSelect.value;
    const quantity = parseInt(quantityInput.value) || 1;
    const product = products.find(p => p.id_product == productId);
    if (product) {
      priceInput.value = product.price;
      totalPriceInput.value = product.price * quantity;
    } else {
      priceInput.value = 0;
      totalPriceInput.value = 0;
    }
    }

    productSelect.addEventListener('change', updatePrice);
    quantityInput.addEventListener('input', updatePrice);

    updatePrice();
  </script>
@endsection