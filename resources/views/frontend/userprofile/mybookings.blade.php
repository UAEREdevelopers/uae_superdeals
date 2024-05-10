@extends('frontend.userprofile.profilepagelayout')

@section('innercontent')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" style="min-height: 20vh">
        @if (Session::has('success'))

            <div class="alert alert-success mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="row pt-4">
                <h5>{{ auth()->user()->name }}'s Bookings</h5>
                <hr>
                <div class="col-md-12">
                   
                </div>
            </div>
        </div>

    </main>
@endsection
