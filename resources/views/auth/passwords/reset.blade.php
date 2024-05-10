@extends('frontend.layouts.frontend')

@section('styles')
<style>
  
.typeahead.dropdown-menu {
  max-height: 230px;
  overflow-y: scroll;
}
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
                    

                 <div id="sign-in-dialog2" class="zoom-anim-dialog">
                    <div class="small-dialog-header">
                        <h3>Reset Password</h3>
                    </div>
                    
                    @if($errors->any())
                        <p>                        
                            {{ implode('', $errors->all('message')) }}                       
                        </p>                     
                     @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="sign-in-wrapper">
                            <div class="form-group">
                                <label>Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                <i class="icon_mail_alt"></i>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <i class="icon_lock_alt"></i>
                                @error('password')
                                        <span class="invalid-feedback text-black" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <i class="icon_lock_alt"></i>
                            </div>
                            <div class="text-center"><button type="submit" class="btn_1 full-width">Reset Password</button></div>
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
