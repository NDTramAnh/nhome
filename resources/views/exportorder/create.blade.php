<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Tìm mã hoặc tên sản phẩm",
            allowClear: true
        });
    });
</script>
<select name="products[0][product_code]" class="form-control select2" required>
    <option value="">-- Chọn sản phẩm --</option>
    @foreach ($products as $product)
        <option value="{{ $product->code }}">
            {{ $product->code }} - {{ $product->name }}
        </option>
    @endforeach
</select>

@extends('home')

@section('main-content')
<h4 class="text-center mb-3">Phiếu xuất kho</h4>

<form action="{{ route('exportorder.store') }}" method="POST">
    @csrf
    <div class="row">
        <!-- Bảng sản phẩm của phiếu xuất -->
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn vị</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <!-- Hàng mẫu để thêm sản phẩm -->
                </tbody>
            </table>

            <div class="mb-2">
                <button type="button" class="btn btn-sm btn-success" id="add-row">Thêm sản phẩm</button>
            </div>

            <div class="text-end fw-bold">Total: <span id="total-value">0</span></div>
        </div>

        <!--form nhập thông tin phiếu xuất-->
        <div class="col-md-4">
            <div class="mb-2">
                <label>Mã phiếu</label>
                <input type="text" name="ma_phieu" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Mã khách hàng</label>
                <input type="text" name="khach_hang" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Ngày tạo</label>
                <input type="date" name="ngay_tao" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Người tạo</label>
                <input type="text" name="nguoi_tao" class="form-control" required>
            </div>

            <input type="hidden" name="tri_gia" id="tri_gia">

            <button type="submit" class="btn btn-primary w-100 mt-2">Xuất</button>
            <a href="{{ route('exportorder.index') }}" class="btn btn-danger w-100 mt-2">Thoát</a>
        </div>
    </div>
</form>

<!-- Script thêm/xoá sản phẩm + tính tổng -->
<script>
    let count = 0;
    const productList = document.getElementById('product-list');
    const totalEl = document.getElementById('total-value');
    const hiddenTotal = document.getElementById('tri_gia');

    document.getElementById('add-row').addEventListener('click', function () {
        count++;
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${count}</td>
            <td><input type="text" name="products[${count}][code]" class="form-control" required></td>
            <td><input type="text" name="products[${count}][name]" class="form-control" required></td>
            <td><input type="text" name="products[${count}][unit]" class="form-control" required></td>
            <td><input type="number" name="products[${count}][price]" class="form-control price" required></td>
            <td><input type="number" name="products[${count}][quantity]" class="form-control quantity" required></td>
            <td class="subtotal">0</td>
            <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
        `;
        productList.appendChild(row);
        calculateTotal();
    });

    productList.addEventListener('input', function () {
        calculateTotal();
    });

    productList.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            calculateTotal();
        }
    });

    function calculateTotal() {
        let total = 0;
        const rows = productList.querySelectorAll('tr');
        rows.forEach(row => {
            const price = parseFloat(row.querySelector('.price')?.value || 0);
            const quantity = parseFloat(row.querySelector('.quantity')?.value || 0);
            const subtotal = price * quantity;
            row.querySelector('.subtotal').textContent = subtotal.toLocaleString();
            total += subtotal;
        });
        totalEl.textContent = total.toLocaleString();
        hiddenTotal.value = total;
    }
</script>
@endsection
