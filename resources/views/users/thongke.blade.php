@extends('dashboard')

@section('content')
<div class="container">
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
            <div class="d-flex mb-3">
                <input type="text" class="form-control w-25 me-2" placeholder="Search">
                <select class="form-select w-25 me-2">
                    <option>Trạng thái tồn</option>
                    <option>Hết hàng</option>
                    <option>Sắp hết</option>
                    <option>Trung bình</option>
                    <option>Còn nhiều</option>
                </select>
                <button class="btn btn-primary">Xuất</button>
            </div>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mã hàng</th>
                        <th>Tên hàng</th>
                        <th>Nhà cung cấp</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Tỷ lệ đầy tủ</th>
                        <th>Tỷ lệ hài lòng</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 10; $i++)
                        <tr>
                            <td>HH0{{ $i }}</td>
                            <td>AAA</td>
                            <td>ABC</td>
                            <td>{{ rand(0, 300) }}</td>
                            <td>{{ ['Hết hàng','Sắp hết','Trung bình','Còn nhiều'][rand(0,3)] }}</td>
                            <td>{{ rand(50,100) }}%</td>
                            <td>{{ rand(50,100) }}%</td>
                        </tr>
                    @endfor
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
            datasets: [
                {
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
