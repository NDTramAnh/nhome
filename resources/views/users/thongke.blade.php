@extends('dashboard')

@section('content')
<div class="row mx-0">
    {{-- SIDEBAR --}}
    <div class="col-md-2 text-center sidebar pe-0" style="min-height: 100vh; background-color: #d8edfd;">
        <ul class="nav flex-column ">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product') ? 'active' : '' }}" href="{{ route('product') }}">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('import.orders') ? 'active' : '' }}" href="{{ route('import.orders') }}">Import_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('export.orders') ? 'active' : '' }}" href="{{ route('export.orders') }}">Export_Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users') ? 'active' : '' }}" href="{{ route('users') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('suppliers') ? 'active' : '' }}" href="{{ route('suppliers') }}">Suppliers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('thongke') ? 'active' : '' }}" href="{{ route('thongke') }}">Inventory_Report</a>
                </li>
                
            </ul>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="col-md-10 pe-0 py-3 ps-3" style="max-width: 100%;">
        <h2 class="mb-4">Thống kê hàng hóa</h2>
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
                <input type="text" name="keyword" class="form-control w-25" placeholder="Tìm theo tên/mã" value="{{ request('keyword') }}">
                <select name="filter" class="form-select w-25" onchange="this.form.submit()">
                    <option value="">Trạng thái tồn</option>
                    <option value="Hết hàng" {{ request('filter') == 'Hết hàng' ? 'selected' : '' }}>Hết hàng</option>
                    <option value="Sắp hết" {{ request('filter') == 'Sắp hết' ? 'selected' : '' }}>Sắp hết</option>
                    <option value="Trung bình" {{ request('filter') == 'Trung bình' ? 'selected' : '' }}>Trung bình</option>
                    <option value="Còn nhiều" {{ request('filter') == 'Còn nhiều' ? 'selected' : '' }}>Còn nhiều</option>
                </select>
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            </form>

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

            <div class="d-flex justify-content-center mt-3">
                {{ $baoCaoTon->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
            </div>
        @endif

        {{-- TAB: Nhập hàng --}}
        @if (request('tab') == 'nhaphang')
            <form method="GET" class="d-flex gap-3 align-items-center mb-3">
                <input type="hidden" name="tab" value="nhaphang">
                <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
                <button class="btn btn-primary">Lọc</button>
            </form>
            <p><strong>Tổng số phiếu nhập:</strong> {{ $tongPhieuNhap ?? '—' }}</p>
            <p><strong>Tổng số lượng nhập:</strong> {{ $tongSoLuongNhap ?? '—' }}</p>
            <p><strong>Tổng giá trị nhập:</strong> {{ isset($tongGiaTriNhap) ? number_format($tongGiaTriNhap) . ' đ' : '—' }}</p>
        @endif

        {{-- TAB: Xuất hàng --}}
        @if (request('tab') == 'xuathang')
            <form method="GET" class="d-flex gap-3 align-items-center mb-3">
                <input type="hidden" name="tab" value="xuathang">
                <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
                <button class="btn btn-primary">Lọc</button>
            </form>
            <p><strong>Tổng số phiếu xuất:</strong> {{ $tongPhieuXuat ?? '—' }}</p>
            <p><strong>Tổng số lượng xuất:</strong> {{ $tongSoLuongXuat ?? '—' }}</p>
        @endif

        {{-- TAB: Biểu đồ --}}
        @if (request('tab') == 'nhapxuat')
            <form method="GET" class="d-flex gap-3 align-items-center mb-3">
                <input type="hidden" name="tab" value="nhapxuat">
                <input type="month" name="month" class="form-control w-25" value="{{ request('month') }}">
                <button class="btn btn-primary">Lọc</button>
            </form>

            @if (!empty($dates) && !empty($importValues) && !empty($exportValues))
                <canvas id="chartNhapXuat" height="150"></canvas>
            @else
                <div class="alert alert-warning">Không có dữ liệu biểu đồ.</div>
            @endif
        @endif
    </div>
</div>

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
                    datasets: [
                        {
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
</script>
@endsection
