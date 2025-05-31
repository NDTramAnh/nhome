@extends('home')

@section('main-content')

<h2 class="mb-4">Thống kê hàng hóa</h2>
@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@else
{{-- Nếu tab hoặc tháng không hợp lệ --}}
@if ($tab === 'invalid' || !empty($invalidMonth))
    <div class="alert alert-danger text-center">
        {{ $tab === 'invalid' ? ($messageError ?? 'Tab không hợp lệ.') : 'Tháng không hợp lệ. Vui lòng chọn lại.' }}
    </div>
@else
<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <li class="nav-item"><a class="nav-link {{ request('tab', 'ton') == 'ton' ? 'active' : '' }}" href="{{ route('thongke', ['tab' => 'ton']) }}">Báo cáo hàng tồn</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab') == 'nhaphang' ? 'active' : '' }}" href="{{ route('thongke', ['tab' => 'nhaphang', 'month' => request('month', now()->format('Y-m'))]) }}">Thống kê nhập hàng</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab') == 'xuathang' ? 'active' : '' }}" href="{{ route('thongke', ['tab' => 'xuathang', 'month' => request('month', now()->format('Y-m'))]) }}">Thống kê xuất hàng</a></li>
    <li class="nav-item"><a class="nav-link {{ request('tab') == 'nhapxuat' ? 'active' : '' }}" href="{{ route('thongke', ['tab' => 'nhapxuat', 'month' => request('month', now()->format('Y-m'))]) }}">Biểu đồ nhập xuất</a></li>
</ul>


{{-- TAB: Hàng tồn --}}
@if (request('tab', 'ton') == 'ton')
<form method="GET" action="{{ route('thongke') }}" class="d-flex gap-3 align-items-center mb-3">
    <input type="hidden" name="tab" value="ton">
<input type="text" name="keyword" class="form-control w-25" placeholder="Tìm theo tên/mã"  value="{{ request('keyword') }}"   minlength="1" maxlength="50" required>
  <div id="error-message" style="color: red; margin-top: 5px;"></div>
    <select name="filter" class="form-select w-25" onchange="this.form.submit()">
        <option value="">Trạng thái tồn</option>
        <option value="Hết hàng" {{ request('filter') == 'Hết hàng' ? 'selected' : '' }}>Hết hàng</option>
        <option value="Sắp hết" {{ request('filter') == 'Sắp hết' ? 'selected' : '' }}>Sắp hết</option>
        <option value="Trung bình" {{ request('filter') == 'Trung bình' ? 'selected' : '' }}>Trung bình</option>
        <option value="Còn nhiều" {{ request('filter') == 'Còn nhiều' ? 'selected' : '' }}>Còn nhiều</option>
    </select>
    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
</form>
@if ($baoCaoTon->count() > 0)
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã hàng</th>
            <th>Tên hàng</th>
            <th>Nhà cung cấp</th>
            <th>Số lượng</th>
            <th>Trạng thái tồn</th>
            <th>Tỷ lệ tiêu thụ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($baoCaoTon as $item)
        <tr>
            <td>{{ $item['ma'] }}</td>
            <td>{{ $item['ten'] }}</td>
            <td>{{ $item['ncc'] }}</td>
            <td>{{ $item['soLuong'] }}</td>
            <td>{{ $item['trangThai'] }}</td>
            <td>{{ $item['tyLeTieuThu'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-right mt-3">
    {{ $baoCaoTon->appends(request()->except('page'))->links('pagination::bootstrap-5') }}

</div>
@else
    @php
        $keyword = request('keyword');
        $filter = request('filter');
    @endphp

    @if ($keyword && $filter)
        <div class="alert alert-info">
            Không tìm thấy sản phẩm "<strong>{{ $keyword }}</strong>" và trạng thái "<strong>{{ $filter }}</strong>".
        </div>
    @elseif ($keyword)
        <div class="alert alert-info">
            Không tìm thấy sản phẩm nào có từ khóa "<strong>{{ $keyword }}</strong>".
        </div>
    @elseif ($filter)
        <div class="alert alert-info">
            Không có sản phẩm nào thuộc trạng thái "<strong>{{ $filter }}</strong>".
        </div>
    @else
        <div class="alert alert-info">
            Không có sản phẩm trong kho.
        </div>
    @endif
@endif

@endif



{{-- TAB: Nhập hàng --}}
@if (request('tab') == 'nhaphang')
<form method="GET" class="d-flex gap-3 align-items-center mb-3">
    <input type="hidden" name="tab" value="nhaphang">
    <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
    <button class="btn btn-primary">Lọc</button>
</form>


    @if (!empty($dsPhieuNhap) && count($dsPhieuNhap) > 0)
        {{-- nội dung bảng phiếu nhập + biểu đồ --}}
        <p><strong>Tổng số phiếu nhập:</strong> {{ $tongPhieuNhap }}</p>
        <p><strong>Tổng số lượng nhập:</strong> {{ $tongSoLuongNhap }}</p>
        <p><strong>Tổng giá trị nhập:</strong> {{ number_format($tongGiaTriNhap) }} đ</p>

        <h5 class="mt-4 text-center">Danh sách phiếu nhập</h5>
        {{-- bảng nhập hàng --}}
        <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Mã phiếu</th>
            <th>Người lập</th>
            <th>Nhà cung cấp</th>
            <th>Ngày nhập</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dsPhieuNhap as $phieu)
        <tr>
            <td>PN{{ $phieu->id_import }}</td>
            <td>{{ $phieu->user_name}}</td>
            <td>{{ $phieu->supplier_name }}</td>
            <td>{{ \Carbon\Carbon::parse($phieu->import_date)->format('d/m/Y') }}</td>
            <td>{{ number_format($phieu->total_price ?? 0) }} đ</td>
        </tr>
        @endforeach
    </tbody>
</table>
        {{ $dsPhieuXuat->links('pagination::bootstrap-5') }}
        {{-- biểu đồ nhà cung cấp nếu có --}}
        @if (!empty($supplierStats) && $supplierStats->count())
            <h5 class="mt-4 text-center">Biểu đồ số lượng của mỗi nhà cung cấp</h5>
            <canvas id="chartSupplier" height="100" class="mt-4"></canvas>
        @endif

    @else
        <div class="alert alert-info mt-3">Không có phiếu nhập nào trong tháng này.</div>
    @endif

@endif



{{-- TAB: Xuất hàng --}}
@if (request('tab') == 'xuathang')
<form method="GET" class="d-flex gap-3 align-items-center mb-3">
    <input type="hidden" name="tab" value="xuathang">
    <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
    <button class="btn btn-primary">Lọc</button>
</form>

    @if (!empty($dsPhieuXuat) && count($dsPhieuXuat) > 0)
        <p><strong>Tổng số phiếu xuất:</strong> {{ $tongPhieuXuat }}</p>
        <p><strong>Tổng số lượng xuất:</strong> {{ $tongSoLuongXuat }}</p>

        <h5 class="mt-4 text-center">Danh sách phiếu xuất</h5>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Mã phiếu</th>
                    <th>Người lập</th>
                    <th>Ngày xuất</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dsPhieuXuat as $phieu)
                <tr>
                    <td>PX{{ $phieu->id }}</td>
                    <td>{{ $phieu->user_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($phieu->created_at)->format('d/m/Y') }}</td>
                    <td>{{ number_format($phieu->total_price ?? 0) }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $dsPhieuXuat->links('pagination::bootstrap-5') }}

        @if (!empty($topSanPhamXuat) && $topSanPhamXuat->count())
            <h5 class="mt-4 text-center">Biểu đồ sản phẩm xuất nhiều trong tháng</h5>
            <canvas id="chartSanPhamXuat" height="100" class="mt-4"></canvas>
        @endif
    @else
        <div class="alert alert-info">Không có phiếu xuất nào trong tháng này.</div>
    @endif

@endif





{{-- TAB: Biểu đồ --}}
@if (request('tab') == 'nhapxuat')
<form method="GET" class="d-flex gap-3 align-items-center mb-3">
    <input type="hidden" name="tab" value="nhapxuat">
    <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
    <button class="btn btn-primary">Lọc</button>
</form>

    @if (collect($importValues)->sum() > 0 || collect($exportValues)->sum() > 0)
        <canvas id="chartNhapXuat" height="150"></canvas>
    @else
        <div class="alert alert-warning">Không có phiếu nhập và xuất trong tháng này.</div>
    @endif
@endif



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = @json($dates ?? []);
    const importValues = @json($importValues ?? []);
    const exportValues = @json($exportValues ?? []);

    if (labels.length && importValues.length && exportValues.length) {
        const ctx = document.getElementById('chartNhapXuat')?.getContext('2d');
        if (ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Số lượng nhập',
                            data: importValues,
                            backgroundColor: 'rgba(54, 162, 235, 0.7)'
                        },
                        {
                            label: 'Số lượng xuất',
                            data: exportValues,
                            backgroundColor: 'rgba(255, 99, 132, 0.7)'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }


    @if (!empty($supplierStats))
    const supplierLabels = @json($supplierStats->pluck('supplier_name'));
    const supplierData = @json($supplierStats->pluck('total'));

    if (supplierLabels.length && supplierData.length) {
        const ctxSup = document.getElementById('chartSupplier')?.getContext('2d');
        if (ctxSup) {
            new Chart(ctxSup, {
                type: 'bar',
                data: {
                    labels: supplierLabels,
                    datasets: [{
                        label: 'Tổng số lượng nhập theo nhà cung cấp',
                        data: supplierData,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    }
@endif


    @if (request('tab') == 'xuathang' && isset($topSanPhamXuat))
    const productLabels = @json($topSanPhamXuat->pluck('product_name'));
    const productData = @json($topSanPhamXuat->pluck('total'));

    if (productLabels.length && productData.length) {
        const ctxProd = document.getElementById('chartSanPhamXuat')?.getContext('2d');
        if (ctxProd) {
            new Chart(ctxProd, {
                type: 'bar',
                data: {
                    labels: productLabels,
                    datasets: [{
                        label: 'Số lượng xuất theo sản phẩm',
                        data: productData,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    }
@endif

  function checkLength() {
    const input = document.getElementById('keyword');
    const errorDiv = document.getElementById('error-message');

    if (input.value.length > 50) {
      errorDiv.textContent = "Từ khóa không được vượt quá 50 ký tự.";
    } else {
      errorDiv.textContent = "";
    }
  }
</script>
@endif
@endif {{-- Kết thúc if $tab !== 'invalid' --}}
@endsection