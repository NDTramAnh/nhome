<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Import_Orders</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e6f0ff;
      margin: 0;
      padding: 0;
    }

    /* Navbar */
    .navbar {
      background-color: #cce5ff;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar-title {
      font-size: 20px;
      font-weight: bold;
    }

    .navbar-user {
      font-size: 24px;
      cursor: pointer;
    }

    .container {
      background-color: white;
      margin: 30px auto;
      padding: 30px;
      width: 90%;
      max-width: 900px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      margin-top: 0;
    }

    .top-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .search-box input {
      padding: 5px;
      font-size: 16px;
    }

    .btn {
      padding: 8px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #aaa;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    .actions a {
      margin: 0 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .actions a.view {
      color: blue;
    }

    .actions a.delete {
      color: red;
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="navbar-title">GoStock</div>
  <div class="navbar-user">👤</div>
</div>

<div class="container">
    <h2>Import_Orders</h2>
  <div class="top-bar">
    <div class="search-box">
        <button class="btn btn-search">Tìm kiếm</button>
      <input type="text" id="search" name="search">
    </div>
    <button class="btn"><a href="./add_import_orders.php" class="view">+ Tạo phiếu nhập</a></button>
  </div>

  <table>
    <thead>
      <tr>
        <th>Mã phiếu</th>
        <th>Ngày nhập</th>
        <th>Người nhập</th>
        <th>Nhà cung cấp</th>
        <th>Tổng tiền</th>
        <th>Tùy chọn</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>HH_01</td>
        <td>31/03/2024</td>
        <td>ABC</td>
        <td>AAA</td>
        <td>25.000.000đ</td>
        <td class="actions"><a href="./inform_of_import.php" class="view">Xem</a><a href="#" class="delete">Xóa</a></td>
      </tr>
      <tr>
        <td>HH_02</td>
        <td>31/03/2024</td>
        <td>ABC</td>
        <td>YYY</td>
        <td>2.900.000đ</td>
        <td class="actions"><a href="./inform_of_import.php" class="view">Xem</a><a href="#" class="delete">Xóa</a></td>
      </tr>
      <tr>
        <td>HH_03</td>
        <td>31/03/2024</td>
        <td>BBC</td>
        <td>ZZZ</td>
        <td>9.000.000đ</td>
        <td class="actions"><a href="./inform_of_import.php" class="view">Xem</a><a href="#" class="delete">Xóa</a></td>
      </tr>
    </tbody>
  </table>
</div>

</body>
</html>
