<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@extends('home')

@section('main-content')
<h4 class="text-center mb-3">Phiếu xuất kho</h4>

<form action="{{ route('exportorder.store') }}" method="POST">
    @csrf
    <div>
        <p>Sản Phẩm</p>
    </div>

    <select id="product-selector" name="products[0][product_code]" class="form-control select2" required>
        <option value="">-- Chọn sản phẩm --</option>
        @foreach ($products as $product)
        <option value="{{ $product->id_product }}">
            {{ $product->id_product }} - {{ $product->name_product }}
        </option>
        @endforeach
    </select>

    <div class="row mt-3">
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

            <div class="text-end fw-bold">Total: <span id="total-value">0</span></div>
        </div>

        <!-- Form nhập thông tin phiếu xuất -->
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
                <input type="date" name="ngay_tao" class="form-control" required value="{{ date('Y-m-d') }}">
            </div>

            <div class="mb-2">
                <label>Người tạo</label>
                <input type="text" name="nguoi_tao" class="form-control" required value="{{ Auth::user()->name ?? '' }}" readonly>
            </div>

            <input type="hidden" name="tri_gia" id="tri_gia">

            <button type="submit" class="btn btn-primary w-100 mt-2">Xuất</button>
            <a href="{{ route('exportorder.index') }}" class="btn btn-danger w-100 mt-2">Thoát</a>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        // Khởi tạo select2
        $('.select2').select2({
            placeholder: "Tìm mã hoặc tên sản phẩm",
            allowClear: true
        });

        // Gán mảng products sang biến JS an toàn
        const products = JSON.parse('{!! addslashes(json_encode($products)) !!}');
        let count = 0;

        // Xử lý khi chọn sản phẩm
        $('#product-selector').on('change', function() {
            const selectedId = $(this).val();
            const product = products.find(p => p.id_product == selectedId);
            if (!product) return;

            count++;

            // Kiểm tra sản phẩm đã tồn tại chưa, tránh thêm trùng
            let exists = false;
            $('#product-list tr').each(function() {
                const code = $(this).find('input[name^="products"]').filter(function() {
                    return $(this).attr('name').endsWith('[code]');
                }).val();
                if (code == product.id_product) {
                    exists = true;
                    return false; // break loop
                }
            });
            if (exists) {
                alert('Sản phẩm này đã được thêm.');
                return;
            }

            const row = `
                <tr>
                    <td>${count}</td>
                    <td><input type="text" class="form-control" name="products[${count}][code]" value="${product.id_product}" readonly></td>
                    <td><input type="text" class="form-control" name="products[${count}][name]" value="${product.name_product}" readonly></td>
                    <td><input type="text" class="form-control" name="products[${count}][unit]" value="${product.category}" readonly></td>
                    <td><input type="number" class="form-control price" name="products[${count}][price]" value="${product.price}" readonly></td>
                    <td><input type="number" class="form-control quantity" name="products[${count}][quantity]" value="1" min="1"></td>
                    <td class="subtotal">${product.price.toLocaleString()}</td>
                    <td><button type="button" class="btn btn-danger btn-sm remove-row">X</button></td>
                </tr>
            `;

            $('#product-list').append(row);
            calculateTotal();
        });

        // Cập nhật thành tiền & tổng khi thay đổi số lượng
        $('#product-list').on('input', '.quantity', function() {
            calculateTotal();
        });

        // Xoá dòng sản phẩm
        $('#product-list').on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            calculateTotal();
        });

        // Hàm tính tổng tiền
        function calculateTotal() {
            let total = 0;

            $('#product-list tr').each(function() {
                const price = parseFloat($(this).find('.price').val()) || 0;
                const quantity = parseFloat($(this).find('.quantity').val()) || 0;
                const subtotal = price * quantity;

                $(this).find('.subtotal').text(subtotal.toLocaleString());
                total += subtotal;
            });

            $('#total-value').text(total.toLocaleString());
            $('#tri_gia').val(total); // Gán giá trị tổng tiền vào input ẩn
        }
    });
</script>
@endsection