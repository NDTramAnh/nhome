<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Information of Import_Orders</title>
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

    .form-group input,
    .form-group select,
    .form-group textarea {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group textarea {
      resize: none;
      height: 80px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      background-color: #f2f2f2;
    }

    table, th, td {
      border: 1px solid #999;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    .footer-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .btn {
      padding: 10px 20px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-export {
      background-color: #d9eaff;
      color: black;
    }

    .btn-save {
      background-color: limegreen;
      color: white;
    }

    .btn-cancel {
      background-color: red;
      color: white;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Information of Import_Orders</h2>

  <div class="form-grid">
    <div class="form-group">
      <label for="product">Tên hàng</label>
      <select id="product" disabled>
        <option value="qad">qad</option>
      </select>
    </div>

    <div class="form-group">
      <label for="price">Đơn giá</label>
      <input type="text" id="price" value="500.000đ" readonly>
    </div>

    <div class="form-group">
      <label for="supplier">Nhà cung cấp</label>
      <input type="text" id="supplier" value="ABC" readonly>
    </div>

    <div class="form-group">
      <label for="note">Ghi chú</label>
      <textarea id="note" readonly></textarea>
    </div>

    <div class="form-group">
      <label for="quantity">Số lượng</label>
      <input type="number" id="quantity" value="50" readonly>
    </div>

    <div class="form-group">
      <label for="date">Ngày nhập</label>
      <input type="text" id="date" value="31/03/2024" readonly>
    </div>

    <div class="form-group">
      <label for="user">Người nhập</label>
      <input type="text" id="user" value="ABC" readonly>
    </div>
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

  <div class="footer-buttons">
    <button class="btn btn-export">Xuất phiếu</button>
    <div>
      <button class="btn btn-save">Lưu</button>
      <button class="btn btn-cancel"><a href="import.orders.blade.php">Hủy</a></button>
    </div>
  </div>
</div>

</body>
</html>
