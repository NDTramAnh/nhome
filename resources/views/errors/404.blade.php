
@extends("dashboard")

@section('content')
    <div class="container text-center mt-5">
        <h2 class="mt-3">Phiếu xuất không tồn tại</h2>
        <p class="text-muted">Đường dẫn bạn truy cập không hợp lệ hoặc phiếu xuất đã bị xoá.</p>
        <a href="{{ route('exportorder.index') }}" class="btn btn-primary mt-4">Quay về danh sách phiếu xuất</a>
    </div>
@endsection
