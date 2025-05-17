<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Chi tiết sản phẩm</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f9f9f9;
    }
    .container {
      max-width: 600px;
      background: white;
      padding: 20px;
      border-radius: 5px;
      border: 1px solid #2196f3;
      margin: auto;
    }
    h2 {
      color: #6a1b9a;
      font-style: italic;
      margin-bottom: 20px;
    }
    .field-label {
      font-weight: bold;
      margin-top: 10px;
    }
    .field-value {
      margin-bottom: 10px;
    }
    a.back-link {
      display: inline-block;
      margin-top: 20px;
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
    <h2>Chi tiết sản phẩm</h2>

    <div>
      <div class="field-label">Mã sản phẩm:</div>
      <div class="field-value">{{ $product->code }}</div>
    </div>

    <div>
      <div class="field-label">Tên sản phẩm:</div>
      <div class="field-value">{{ $product->name_product }}</div>
    </div>

    <div>
      <div class="field-label">Danh mục:</div>
      <div class="field-value">{{ $product->category }}</div>
    </div>

    <div>
      <div class="field-label">Mô tả:</div>
      <div class="field-value">{{ $product->description }}</div>
    </div>

    <div>
      <div class="field-label">Số lượng trong kho:</div>
      <div class="field-value">{{ $product->stock_quantity }}</div>
    </div>

    <div>
      <div class="field-label">Giá tiền:</div>
      <div class="field-value">{{ number_format($product->price, 0, ',', '.') }} VND</div>
    </div>

    <div>
      <div class="field-label">Tình trạng:</div>
      <div class="field-value">{{ $product->status }}</div>
    </div>

    <a href="{{ route('products.index') }}" class="back-link">← Quay lại danh sách sản phẩm</a>
  </div>
</body>
</html>
