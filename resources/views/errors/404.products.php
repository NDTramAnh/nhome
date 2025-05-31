
@extends("dashboard")

@section('content')
    <div class="container text-center mt-5">
        <h2 class="mt-3">Sản phẩm không tồn tại</h2>
        <p class="text-muted">Sản phẩm bạn tìm kiếm không tồn tại hoặc đã bị xoá.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-4">Quay về danh sách sản phẩm</a>
    </div>
@endsection