@extends('dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
    <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
</div>
@endsection