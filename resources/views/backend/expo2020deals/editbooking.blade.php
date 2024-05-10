@extends('backend.layout.index')

@section('content')

<div class="page-content">
    
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
	{{session('success')}}
</div>
@endif

<div class="row">
      <div class="col-md-12 stretch-card">
         <div class="card">
            <div class="card-body">
                <h4>Edit booking</h4>
                <form action="{{route('update_expodeals_booking')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$booking->id}}">
                  <label for="select">Change Status</label>
                <select name="status" id="select" class="form-control">
                    <option value="" selected disabled>Select status</option>
                    <option value="completed" @if($booking->booking_status == 'completed') selected @endif>Completed</option>
                    <option value="Pending" @if($booking->booking_status == 'Pending') selected @endif>Pending</option>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Save</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

@endsection


{{-- Custom scripts for current page --}}
@push('scripts')


@endpush
