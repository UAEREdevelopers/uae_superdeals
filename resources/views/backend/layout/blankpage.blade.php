@extends('backend.layout.index')

@section('content')

<div class="page-content">
    
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
	{{session('success')}}
</div>
@endif

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')

@endpush
