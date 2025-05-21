@extends('dashboard')

@section('content')
<div class="container pe-0">
    <h2 class="mb-4">Thống kê hàng hóa</h2>
    <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="ton-tab" data-bs-toggle="tab" data-bs-target="#ton" type="button" role="tab">Báo cáo hàng tồn</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="nhaphang-tab" data-bs-toggle="tab" data-bs-target="#nhaphang" type="button" role="tab">Thống kê nhập hàng</button>
        </li>

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="nhapxuat-tab" data-bs-toggle="tab" data-bs-target="#nhapxuat" type="button" role="tab">Biểu đồ nhập xuất</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-- hàng hóa -->
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

        <!--nhập hàng -->
        <div class="tab-pane fade" id="nhaphang" role="tabpanel">
            <!-- form chọn ngày -->
            <form method="GET" action="{{ route('thongke') }}" class="d-flex gap-3 align-items-center mb-3">
                <input type="hidden" name="tab" value="nhaphang">
                <label>Chọn thời gian:</label>
                <input type="month" name="month" class="form-control w-25" value="{{ request('month', now()->format('Y-m')) }}">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>

            <!-- kết quả -->
            <div>
                <p><strong>Tổng số phiếu nhập:</strong> {{ $tongPhieuNhap ?? 'Không có dữ liệu' }}</p>
                <p><strong>Tổng số lượng hàng nhập:</strong> {{ $tongSoLuongNhap ?? 'Không có dữ liệu' }}</p>
                <p><strong>Tổng giá trị nhập hàng:</strong> {{ isset($tongGiaTriNhap) ? number_format($tongGiaTriNhap) . ' đ' : 'Không có dữ liệu' }}</p>
            </div>
        </div>


        <!-- biểu đồ -->
        <div class="tab-pane fade" id="nhapxuat" role="tabpanel">
            <form method="GET" class="d-flex align-items-center mb-3" action="{{ route('thongke') }}">
                <input type="hidden" name="tab" value="nhapxuat">
                <label class="me-2">Tháng:</label>
                <input type="month" name="month" class="form-control w-25 me-2" value="{{ request('month') }}">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </form>

            @if (empty($dates) || empty($importValues) || empty($exportValues))
            <div class="alert alert-warning">Không có dữ liệu để hiển thị biểu đồ.</div>
            @else
            <canvas id="chartNhapXuat" height="150"></canvas>
            @endif

        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tab = '{{ request("tab") }}';

        if (tab === 'nhapxuat') {
            new bootstrap.Tab(document.querySelector('#nhapxuat-tab')).show();
        } else if (tab === 'nhaphang') {
            new bootstrap.Tab(document.querySelector('#nhaphang-tab')).show();
        }

        const labels = @json($dates);
        const importValues = @json($importValues);
        const exportValues = @json($exportValues);

        if (labels.length && importValues.length && exportValues.length) {
            const ctx = document.getElementById('chartNhapXuat').getContext('2d');
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
    });
</script>
@endsection