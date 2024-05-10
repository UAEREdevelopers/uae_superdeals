@extends('frontend.layouts.frontend')

@section('styles')
 <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
<style>
  
.typeahead.dropdown-menu {
  max-height: 230px;
  overflow-y: scroll;
}

.roomdetails p {
	margin-bottom: 2px;
}

.selectize-country-cart>.selectize-input{
    padding-top: 2px !important;
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

            <div class="hero_in cart_section">
                <div class="wrapper">
                    <div class="container">
                        <div class="bs-wizard clearfix">
                            <div class="bs-wizard-step">
                                <div class="text-center bs-wizard-stepnum">SELECT</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="cart-1.html" class="bs-wizard-dot"></a>
                            </div>

                            <div class="bs-wizard-step active">
                                <div class="text-center bs-wizard-stepnum">DETAILS</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#0" class="bs-wizard-dot"></a>
                            </div>

                            <div class="bs-wizard-step disabled">
                                <div class="text-center bs-wizard-stepnum">Finish!</div>
                                <div class="progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <a href="#0" class="bs-wizard-dot"></a>
                            </div>
                        </div>
                        <!-- End bs-wizard -->
                    </div>
                </div>
		    </div>
		<!--/hero_in-->
        <form action="{{route('buy_product')}}" method="POST">

            @csrf
		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-9">
						<div class="box_cart">
						{{-- <div class="message">
							<p>Exisitng Customer? <a href="#0">Click here to login</a></p>
						</div> --}}
						<div class="form_title">
							<h3><strong>1</strong>Your Details</h3>
							<p>
							
							</p>
						</div>

					

						<div class="step">
							<div class="row">									
							<div class="col-sm-6">
								<div class="form-group">
									{{-- <label>First name</label> --}}
									<input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" required minlength="3">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									{{-- <label>Last name</label> --}}
									<input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname" required>
								</div>
							</div>					
						
						</div>
                        <div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									{{-- <label>Email</label> --}}
									<input type="email" id="email_booking" placeholder="Email" name="email" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									{{-- <label>Phone</label> --}}
									<input type="text" id="phone" name="phone" placeholder="Phone"  class="form-control" required>
								</div>
							</div>
						</div>
                        </div>
						<hr>
						<!--End step -->
						<div class="form_title">
							<h3><strong>2</strong>Billing Address</h3>
							<p>
								
							</p>
						</div>
						<div class="step">							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Address ( Flat / Bldng) </label>
										<input type="text" id="street_1" name="address" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Street</label>
										<input type="text" id="street_2" name="street" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-sm-12">
									<div class="form-group">
										<label>City</label>
										<input type="text" id="city_booking" name="city" class="form-control" required>
									</div>
								</div>

                                <div class="col-sm-6">
									<div class="form-group">
										<label>Country</label>
										<div class="custom-select-form">
										<select class="wide add_bottom_15 selectize-country-cart" name="country" id="country" required>
											<option value="">Select your country</option>

                                            @foreach($countries as $country)

											<option value="{{$country->country_id}}|{{$country->country_name}}" @if($country->CountryCode == 'AE') selected @endif>{{$country->country_name}}</option>

                                            @endforeach

										</select>
										</div>
									</div>
								</div>
							</div>
                            <div class="row">
								
							</div>
							<!--End row -->
						</div>
						<hr>
						<!--End step -->
						
						</div>

					</div>
					<!-- /col -->
					
					<aside class="col-lg-3" id="sidebar">
						<div class="box_detail">
							<div id="total_cart">
								Total <span class="float-right">{{ number_format(get_total_price() ,2 )  }} AED </span>
							</div>
							<ul class="cart_details">	

                                @php $cart = session()->get('cart')   @endphp
                                @forelse( $cart as $item)	

                                @php 
                                if($item['qty'] % 2 == 0   ){
                                    $price = $item['qty'] * 100;
                                }else{
                                    $price = $item['price'];
                                }
                                @endphp
                                <li>{{$item['product']}} x {{$item['qty']}} : AED {{number_format($price,2) }} </li>
                                @empty 


                                @endforelse
							</ul>
							<button type="submit" class="btn_1 full-width purchase">Buy Now</button>
							<div class="text-center"><small></small></div>
						</div>
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
    </form>
		<!-- /bg_color_1 -->
         
        </main>
        <!-- /main -->
       @include('frontend.layouts.footer')
    </div>
    <!-- page -->
    <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>   
    <script src="{{ asset('js/selectize.js') }}"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <script src="{{ asset('js/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>

    <!-- phone -->
    <script>
        var phone = document.querySelector("#phone");
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        var iti = window.intlTelInput(phone, {
            utilsScript: "{{ asset('js/utils.js') }}",
            initialCountry: "auto",
            preferredCountries: ['AE', 'US', 'UK', 'SA', 'QA', 'OM', 'IN'],
            setNumber: true,
            formatOnDisplay: true,
            nationalMode: true,
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });

        var reset = function() {
            phone.classList.remove("error");
        };

        // on blur: validate
        phone.addEventListener('keyup', function() {
            reset();
            if (phone.value.trim()) {
                if (iti.isValidNumber()) {
                    phone.classList.remove("is-invalid");
                    phone.classList.add("is-valid");
                    document.querySelector("#phone").value = iti.getNumber();
                } else {
                    phone.classList.remove("is-valid");
                    phone.classList.add("is-invalid");
                }
            }
        });

        // on keyup / change flag: reset
        phone.addEventListener('change', reset);
        phone.addEventListener('keyup', reset);
    </script>


	 <script>
            $("#country").selectize({
                placeholder: 'Country'
                });
        </script>

        @if (Session::has('success'))
            <script>
                firealert({{ session('success') }} , 'success');
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                firealert({{ session('error') }}, 'error');
            </script>
        @endif


</body>
@endsection
