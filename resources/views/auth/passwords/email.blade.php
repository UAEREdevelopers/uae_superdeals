

@extends('frontend.layouts.frontend')

@section('styles')
<style>
  

</style>
@endsection


@section('content')
    <body>
    <!-- Remove this class to disable datepicker full on mobile -->

    <div id="page">
               <!-- /header -->
            @include('frontend.layouts.navbar')          
        
        <!-- /header -->
        <main>

       

            <div id="error_page">
                    

                 <div id="sign-in-dialog" class="zoom-anim-dialog login-width">
                    <div class="small-dialog-header">
                        <h3>Reset Password</h3>
                    </div>
                    
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      
                        <div class="sign-in-wrapper">
                            <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 text-center">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn_1">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
		    </div>
         
        </main>
        <!-- /main -->

        
       
        <!--form -->
    </div>
       @include('frontend.layouts.footer')
    </div>
    <!-- page -->
    <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>   

</body>
@endsection


