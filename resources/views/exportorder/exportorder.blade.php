@extends('home')

@section('main-content')
<h4>Export_Orders</h4>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('exportorder.create') }}" class="btn btn-primary">+ Add</a>
    <form class="d-flex" method="GET" action="{{ route('export.orders') }}">
        <input class="form-control me-2" type="search" placeholder="Search..." name="search"
            value="{{ request('search') }}" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>

        <select style="margin-left: 10px;" name="sort" class="form-control" style="width: auto;">
            <option value="desc" {{ $sortOrder == 'desc' ? 'selected' : '' }}>Mới nhất trước</option>
            <option value="asc" {{ $sortOrder == 'asc' ? 'selected' : '' }}>Cũ nhất trước</option>
        </select>
    </form>
</div>
<script>
    document.querySelector('select[name="sort"]').addEventListener('change', function() {
        this.form.submit();
    });
</script>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>Mã phiếu</th>
            <th>Khách hàng</th>
            <th>Người tạo</th>
            <th>Ngày tạo</th>
            <th>Trị giá</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if ($exportOrders->count() > 0)
        @foreach ($exportOrders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->id_customer }}</td>
            <td>{{ $order->user->name }}</td>
            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d/m/Y') }}</td>
            <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
            <td>
                <div class="d-flex gap-2">
                    @php
                    $deleteKey = md5('delete-secret-' . $order->id);
                    @endphp

                    <form action="{{ route('exportorder.destroy', ['id' => $order->id, 'key' => $deleteKey]) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn xoá phiếu xuất này không?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>

                    <a href="{{ route('exportorder.print', $order->id) }}" target="_blank" class="btn btn-primary btn-sm">Print</a>
                    <a href="{{ route('exportorder.show', $order->id) }}" class="btn btn-secondary btn-sm">View</a>
                </div>

            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No result</td>
        </tr>
        @endif
    </tbody>

</table>
<div class="d-flex justify-content-center mt-3">
    {{ $exportOrders->links() }}
</div>

@endsection