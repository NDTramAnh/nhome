@extends('dashboard')

@section('content')

                <h4><strong>Welcome: {{ Auth::user()->name }}</strong></h4>
                <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
           
@endsection
