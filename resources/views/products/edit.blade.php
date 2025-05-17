<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Cập nhật sản phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      width: 90%;
      background: white;
      padding: 30px 25px;
      border-radius: 10px;
      border: 1px solid #2196f3;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    h2 {
      color: #6a1b9a;
      font-style: italic;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
      color: #333;
    }
    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 8px 10px;
      margin-bottom: 15px;
      border: 1px solid #90caf9;
      border-radius: 4px;
      font-size: 14px;
      box-sizing: border-box;
    }
    button {
      background-color: #6a1b9a;
      color: white;
      border: none;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    button:hover {
      background-color: #4a0f6a;
    }
    a.back-link {
      display: inline-block;
      margin-bottom: 15px;
      color: #2196f3;
      text-decoration: none;
      font-weight: bold;
    }
    a.back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="{{ route('products.index') }}" class="back-link">← Quay lại danh sách</a>
    <h2>Cập nhật sản phẩm</h2>

    @if ($errors->any())
      <div style="color: red; margin-bottom: 15px;">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('products.update', $product->id_product) }}" method="POST">
      @csrf
      @method('PUT')

      <label for="name_product">Tên sản phẩm</label>
      <input type="text" id="name_product" name="name_product" value="{{ old('name_product', $product->name_product) }}" required />

      <label for="category">Danh mục</label>
      <input type="text" id="category" name="category" value="{{ old('category', $product->category) }}" required />

      <label for="stock_quantity">Số lượng trong kho</label>
      <input type="number" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0" />

      <label for="price">Giá tiền (VND)</label>
      <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}" required min="0" />

      <label for="status">Tình trạng</label>
      <select id="status" name="status" required>
        <option value="">-- Chọn tình trạng --</option>
        <option value="1" {{ (old('status', $product->status) == '1') ? 'selected' : '' }}>Còn hàng</option>
        <option value="0" {{ (old('status', $product->status) == '0') ? 'selected' : '' }}>Hết hàng</option>
        <option value="2" {{ (old('status', $product->status) == '2') ? 'selected' : '' }}>Tạm ngưng bán</option>
      </select>

      <button type="submit">Cập nhật</button>
    </form>
  </div>
</body>
</html>
