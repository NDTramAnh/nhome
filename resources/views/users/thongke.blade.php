@extends('dashboard')

@section('content')
<div class="container pe-0">
    <h2 class="mb-4">Thống kê hàng hóa</h2>
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ton-tab" data-bs-toggle="tab" data-bs-target="#ton" type="button" role="tab">Báo cáo hàng tồn</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="nhapxuat-tab" data-bs-toggle="tab" data-bs-target="#nhapxuat" type="button" role="tab">Thống kê nhập xuất</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ton" role="tabpanel">

            <form method="GET" action="{{ route('thongke') }}" class="d-flex gap-3 mb-3 align-items-center">
                {{-- Tìm theo tên sản phẩm --}}
                <input type="text" name="keyword" class="form-control w-25" placeholder="Tìm theo tên hoặc mã sản phẩm" value="{{ request('keyword') }}">

                {{-- Nút tìm kiếm --}}
                <button type="submit" class="btn btn-primary">Tìm kiếm</button>

                {{-- Dropdown lọc tự động --}}
                <select name="filter" class="form-select w-25" onchange="this.form.submit()">
                    <option value="">Trạng thái tồn</option>
                    <option value="Hết hàng" {{ request('filter') == 'Hết hàng' ? 'selected' : '' }}>Hết hàng</option>
                    <option value="Sắp hết" {{ request('filter') == 'Sắp hết' ? 'selected' : '' }}>Sắp hết</option>
                    <option value="Trung bình" {{ request('filter') == 'Trung bình' ? 'selected' : '' }}>Trung bình</option>
                    <option value="Còn nhiều" {{ request('filter') == 'Còn nhiều' ? 'selected' : '' }}>Còn nhiều</option>
                </select>

                 <a href="{{ route('thongke') }}" class="btn btn-primary">Reset</a>

                {{-- Nút xuất tạm thời --}}
                <button type="button" class="btn btn-outline-danger text-danger">Xuất Excel</button>

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
        </div>
        <div class="tab-pane fade" id="nhapxuat" role="tabpanel">
            <div class="d-flex align-items-center mb-3">
                <label class="me-2">Tháng:</label>
                <input type="month" class="form-control w-25">
            </div>
            <canvas id="chartNhapXuat" height="150"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartNhapXuat').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['AAA', 'BBB', 'CCC', 'AAA', 'BBB', 'CCC'],
            datasets: [{
                    label: 'Số lượng nhập',
                    data: [120, 180, 90, 160, 110, 130],
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Số lượng xuất',
                    data: [100, 150, 60, 140, 90, 110],
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
</script>
@endsection