
@extends("dashboard")

@section('content')
    <div class="container text-center mt-5">
        <h2 class="mt-3">Phiếu nhập không tồn tại</h2>
        <p class="text-muted">Đường dẫn bạn truy cập không hợp lệ hoặc phiếu nhập đã bị xoá.</p>
        <a href="{{ route('import.page') }}" class="btn btn-primary mt-4">Quay về danh sách phiếu nhập</a>
    </div>
    
@endsection
