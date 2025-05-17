<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Thêm sản phẩm mới</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      padding: 20px;
    }
    .container {
  max-width: 600px;
  width: 90%; /* co giãn tốt trên màn nhỏ */
  background: white;
  padding: 30px 25px;
  border-radius: 10px;
  border: 1px solid #2196f3;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

  /* Căn giữa màn hình */
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
    textarea,
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
    <h2>Thêm sản phẩm mới</h2>

    @if ($errors->any())
      <div style="color: red; margin-bottom: 15px;">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
      @csrf

      <label for="code">Mã sản phẩm</label>
      <input type="text" id="code" name="code" value="{{ old('code') }}" required />

      <label for="name_product">Tên sản phẩm</label>
      <input type="text" id="name_product" name="name_product" value="{{ old('name_product') }}" required />

      <label for="category">Danh mục</label>
      <input type="text" id="category" name="category" value="{{ old('category') }}" required />

      <label for="description">Mô tả</label>
      <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

      <label for="stock_quantity">Số lượng trong kho</label>
      <input type="text" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity') }}" required pattern="\d+" title="Chỉ nhập số" />

      <label for="price">Giá tiền (VND)</label>
      <input type="text" id="price" name="price" value="{{ old('price') }}" required pattern="\d+" title="Chỉ nhập số" />

      <label for="status">Tình trạng</label>
      <select id="status" name="status" required>
        <option value="">-- Chọn tình trạng --</option>
        <option value="Còn hạn sử dụng" {{ old('status') == 'Còn hạn sử dụng' ? 'selected' : '' }}>Còn hạn sử dụng</option>
        <option value="Hết hạn" {{ old('status') == 'Hết hạn' ? 'selected' : '' }}>Hết hạn</option>
        <option value="Tạm ngưng bán" {{ old('status') == 'Tạm ngưng bán' ? 'selected' : '' }}>Tạm ngưng bán</option>
      </select>

      <button type="submit">Lưu</button>
    </form>
  </div>
</body>
</html>
