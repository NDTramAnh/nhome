@extends("dashboard")

@section('content')
    <div class="alert alert-danger mt-5 text-center">
        <h4>⚠️ Trang bạn yêu cầu không tồn tại hoặc không hợp lệ.</h4>
       <a href="{{ route('export.orders') }}" class="btn btn-primary mt-3">Quay lại danh sách</a>
    </div>
@endsection
