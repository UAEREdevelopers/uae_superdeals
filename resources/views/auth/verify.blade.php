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
    <body class="datepicker_mobile_full">
    <!-- Remove this class to disable datepicker full on mobile -->

    <div id="page">
               <!-- /header -->
            @include('frontend.layouts.navbar')          
        
        <!-- /header -->
        <main>

            <div id="error_page">
			<div class="container">
				<div class="row justify-content-center text-center">
					<div class="col-xl-7 col-lg-9">
						<h2> {{ __('Verify Your Email Address') }}</h2>

						<div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                               <p>{{ __('Before proceeding, please check your email for a verification link.') }} {{ __('If you did not receive the email') }}, </p> 
                                
                               <div class="search_bar_error">
								<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                    @csrf
                                    <input type="submit" class="btn_1 outline p-0 m-0 align-baseline" value="{{ __('click here to Resend') }}">
                                </form>
							</div>

                                
                            </div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
         
        </main>
        <!-- /main -->
       @include('frontend.layouts.footer')
    </div>
    <!-- page -->
    <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>   

</body>
@endsection
