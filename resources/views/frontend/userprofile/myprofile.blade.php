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
                <h5>{{ auth()->user()->name }}'s Profile</h5>
                <hr>
                <div class="col-md-12">
                    <form action="{{ route('update-profile') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', auth()->user()->name) }}" placeholder="Full Name">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="">Password</label>
                                <input type="text" class="form-control" name="password" placeholder="New Password">
                                @if ($errors->has('password'))
                                    <div class="invalid-feedback d-block">{{ $errors->first('password') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" class="btn_1 profile-submit-btn">update</button>
                            </div>

                        </div>


                    </form>
                </div>
            </div>
        </div>

    </main>
@endsection
