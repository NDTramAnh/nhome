<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Add Import_Orders</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e6f0ff;
      margin: 0;
      padding: 0;
    }

    .container {
      background-color: white;
      margin: 30px auto;
      padding: 30px;
      width: 90%;
      max-width: 950px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      margin-top: 0;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    .form-group label {
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input, .form-group select, .form-group textarea {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group textarea {
      resize: none;
      height: 80px;
    }

    .form-row {
      display: flex;
      align-items: center;
      margin-top: 20px;
    }

    .form-row .form-group {
      flex: 1;
      margin-right: 10px;
    }

    .form-row button {
      height: 35px;
      padding: 0 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }

    table, th, td {
      border: 1px solid #aaa;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    .action-buttons {
      display: flex;
      justify-content: flex-end;
      margin-top: 20px;
    }

    .btn-save {
      background-color: limegreen;
      color: white;
      padding: 10px 20px;
      margin-right: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn-cancel {
      background-color: red;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Add Import_Orders</h2>

  <div class="form-grid">
    <div class="form-group">
      <label for="product">Tên hàng</label>
      <select id="product">
        <option value="qad">qad</option>
      </select>
    </div>

    <div class="form-group">
      <label for="price">Đơn giá</label>
      <input type="text" id="price" value="500.000đ" readonly>
    </div>

    <div class="form-group">
      <label for="supplier">Nhà cung cấp</label>
      <input type="text" id="supplier" value="ABC">
    </div>

    <div class="form-group">
      <label for="note">Ghi chú</label>
      <textarea id="note"></textarea>
    </div>

    <div class="form-group">
      <label for="quantity">Số lượng</label>
      <input type="number" id="quantity" value="50">
    </div>

    <div class="form-group">
      <label for="date">Ngày nhập</label>
      <input type="text" id="date" value="31/03/2024">
    </div>

    <div class="form-group">
      <label for="user">Người nhập</label>
      <input type="text" id="user" value="ABC">
    </div>
  </div>

  <div class="form-row">
    <button>Thêm</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>STT</th>
        <th>Tên hàng</th>
        <th>Số lượng</th>
        <th>Đơn giá</th>
        <th>Tổng tiền</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>qad</td>
        <td>50</td>
        <td>500.000đ</td>
        <td>25.000.000đ</td>
      </tr>
    </tbody>
  </table>

  <div class="action-buttons">
    <button class="btn-save">Lưu</button>
    <button class="btn-cancel"><a href="import.orders.blade.php">Hủy</a></button>
  </div>
</div>

</body>
</html>
