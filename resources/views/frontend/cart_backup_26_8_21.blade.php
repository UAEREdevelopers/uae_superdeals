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
        <form action="{{route('book_hotel_tbo')}}" method="POST">

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
                                <div class="col-sm-2">
								<div class="form-group">
									<label>Title</label>
									<select name="guest[adult][0][title]" class="form-control" id="" required>
                                         <option value="Title" disabled selected>Title</option>
                                        <option value="Mr.">Mr</option>
                                        <option value="Mrs.">Mrs</option>
                                       
                                    </select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>First name</label>
									<input type="text" class="form-control" id="firstname_booking" name="guest[adult][0][firstname]" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Last name</label>
									<input type="text" class="form-control" id="lastname_booking" name="guest[adult][0][lastname]" required>
								</div>
							</div>
                            <div class="col-sm-2">
								<div class="form-group">
									<label>Age</label>
									<input type="number" class="form-control" id="" name="guest[adult][0][age]" required>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Room No.</label>
									<select name="guest[adult][0][room]" id="" class="form-control" readonly>
										<option value="1" selected readonly>1</option>
										{{-- @for($i= 1 ; $i<session('searchData.rooms'); $i++)
										<option value="{{$i+1}}">{{$i+1}}</option>
										@endfor --}}
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<input type="email" id="email_booking" name="email" class="form-control" required>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Phone</label>
									<input type="text" id="" name="phone" class="form-control" required>
								</div>
							</div>
						</div>
						</div>
						<hr>
						<!--End step -->

                        <!-- Other Guests section -->
                            @php
                            $guests = (int) session('searchData.adults') + (int) session('searchData.children') ; 
                            @endphp
                        @if (  $guests  > 1 )

                        <div class="form_title">
							<h3><strong>2</strong>Other Guests</h3>
							<p>
							
							</p>
						</div>
						<div class="step">
                            @for($i = 0 ; $i < session('searchData.adults') - 1  ; $i++)
							<h5>Adults</h5>
							<div class="row">
                                <div class="col-sm-2">
								<div class="form-group">
									<label>Title</label>
									<select name="guest[adult][{{$i+1}}][title]" class="form-control" id="" required>
                                         <option value="Title" disabled selected>Title</option>
                                        <option value="Mr.">Mr</option>
                                        <option value="Mrs.">Mrs</option>
                                       
                                    </select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>First name</label>
									<input type="text" class="form-control" id="firstname_booking" name="guest[adult][{{$i+1}}][firstname]" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Last name</label>
									<input type="text" class="form-control" id="lastname_booking" name="guest[adult][{{$i+1}}][lastname]" required>
								</div>
							</div>
                            <div class="col-sm-2">
								<div class="form-group">
									<label>Age</label>
									<input type="number" class="form-control" id="" name="guest[adult][{{$i+1}}][age]" required>
								</div>
							</div>
							 <div class="col-sm-2">
								<div class="form-group">
									<label>Room No.</label>
									<select name="guest[adult][{{$i+1}}][room]" id="" class="form-control">
										<option value="1" selected>1</option>
										@for($j = 1 ; $j<session('searchData.rooms'); $j++)
										<option value="{{$j+1}}">{{$j+1}}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>

                        @endfor

						{{-- for kids --}}
						@php $children_age = session('searchData.children_age') @endphp
						@for($j = 0 ; $j < session('searchData.children')  ; $j++)
						<h5>Children</h5>
							<div class="row">
                                <div class="col-sm-2">
								<div class="form-group">
									<label>Title</label>
									<select name="guest[child][{{$j+1}}][title]" class="form-control" id="" required>
                                         <option value="Title" disabled selected>Title</option>
                                        <option value="Mr.">Mr</option>
                                        <option value="Mrs.">Mrs</option>
                                       
                                    </select>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>First name</label>
									<input type="text" class="form-control" id="firstname_booking" name="guest[child][{{$j+1}}][firstname]" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<label>Last name</label>
									<input type="text" class="form-control" id="lastname_booking" name="guest[child][{{$j+1}}][lastname]" required>
								</div>
							</div>
                            <div class="col-sm-2">
								<div class="form-group">
									<label>Age</label>
									<input type="number" class="form-control" id=""
									@if(isset($children_age[$j]))
									value="{{$children_age[$j]}}" readonly
									@endif
									name="guest[child][{{$j+1}}][age]" required>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<label>Room No.</label>
									<select name="guest[child][{{$j+1}}][room]" id="" class="form-control">
										<option value="1" selected>1</option>
										@for($k = 1 ; $k<session('searchData.rooms'); $k++)
										<option value="{{$k+1}}">{{$k+1}}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>

                        @endfor

						</div>
						<hr>
                        @endif

						{{-- <div class="form_title">
							<h3><strong>2</strong>Payment Information</h3>
							<p>
								Mussum ipsum cacilds, vidis litro abertis.
							</p>
						</div> 
						<div class="step">
							<div class="form-group">
							<label>Name on card</label>
							<input type="text" class="form-control" id="name_card_bookign" name="name_card_bookign">
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="form-group">
									<label>Card number</label>
									<input type="text" id="card_number" name="card_number" class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-sm-12">
								<img src="img/cards_all.svg" alt="Cards" class="cards-payment">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Expiration date</label>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" id="expire_month" name="expire_month" class="form-control" placeholder="MM">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" id="expire_year" name="expire_year" class="form-control" placeholder="Year">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Security code</label>
									<div class="row">
										<div class="col-4">
											<div class="form-group">
												<input type="text" id="ccv" name="ccv" class="form-control" placeholder="CCV">
											</div>
										</div>
										<div class="col-8">
											<img src="img/icon_ccv.gif" width="50" height="29" alt="ccv"><small>Last 3 digits</small>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--End row -->

						<hr> --}}

						<div class="form_title">
							<h3><strong>3</strong>Billing Address</h3>
							<p>
								
							</p>
						</div>
						<div class="step">							
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Address ( Flat / Bldng) </label>
										<input type="text" id="street_1" name="street_1" class="form-control" required>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Street</label>
										<input type="text" id="street_2" name="street_2" class="form-control" required>
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
								<div class="col-md-3 col-sm-6">
									<div class="form-group">
										<label>State</label>
										<input type="text" id="state_booking" name="state" class="form-control" required>
									</div>
								</div>
								<div class="col-md-3 col-sm-6">
									<div class="form-group">
										<label>Postal code</label>
										<input type="number" id="postal_code" name="postal_code" class="form-control" required>
									</div>
								</div>
							</div>
                            <div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label>Country</label>
										<div class="custom-select-form">
										<select class="wide add_bottom_15" name="country" id="country" required>
											<option value="" selected>Select your country</option>

                                            @foreach($countries as $country)

											<option value="{{$country->country_id}}|{{$country->country_name}}">{{$country->country_name}}</option>

                                            @endforeach

										</select>
										</div>
									</div>
								</div>
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
								Total <span class="float-right">{{$price }} AED </span>
							</div>
							<ul class="cart_details">
								<li>From <span>{{session('searchData.CheckInDate')}}</span></li>
								<li>To <span>{{session('searchData.CheckOutDate')}}</span></li>
								<li>Adults <span>{{session('searchData.adults')}}</span></li>
								<li>Childs <span>{{session('searchData.children')}}</span></li>
							</ul>
							<button type="submit" class="btn_1 full-width purchase">Book Now</button>
							<div class="text-center"><small>No money charged in this step</small></div>
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

</body>
@endsection
