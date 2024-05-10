@extends('frontend.layouts.frontend')

@section('styles')
<style>
  
.typeahead.dropdown-menu {
  max-height: 230px;
  overflow-y: scroll;
}

.roomdetails p {
	margin-bottom: 2px;
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

						@foreach(session('searchData.roomguests') as $index => $guest)

						@php 
						$adults = $guest['adultcount'];
						$children = $guest['childcount']; 
						@endphp
						<div class="step">
							<h5>Room {{$index + 1 }}</h5>

							@for( $i = 0 ; $i< $adults; $i++)
								<h6>Adult {{$i+1}} </h6>
							<div class="row">		
								
								<input type="hidden" name="guest[{{$index}}][adult][{{$i}}][room]" id="" readonly value="{{$index+1}}">	
                                <div class="col-sm-2">
								<div class="form-group">
									{{-- <label>Title</label> --}}
									<select name="guest[{{$index}}][adult][{{$i}}][title]" class="form-control" id="" required>
                                         <option value="Title" disabled selected>Title</option>
                                        <option value="Mr.">Mr</option>
										<option value="Ms.">Ms</option>
                                        <option value="Mrs.">Mrs</option>
                                       
                                    </select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									{{-- <label>First name</label> --}}
									<input type="text" class="form-control" id="firstname_booking" placeholder="First Name" name="guest[{{$index}}][adult][{{$i}}][firstname]" required minlength="3">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									{{-- <label>Last name</label> --}}
									<input type="text" class="form-control" id="lastname_booking" placeholder="Last Name" name="guest[{{$index}}][adult][{{$i}}][lastname]" required>
								</div>
							</div>
                            <div class="col-sm-2">
								<div class="form-group">
									{{-- <label>Age</label> --}}
									<input type="number" class="form-control" placeholder="Age" id="" name="guest[{{$index}}][adult][{{$i}}][age]" required>
								</div>
							</div>
						</div>

						@if( $index == 0 )
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
									<input type="text" id="" name="phone" placeholder="Phone"  class="form-control" required>
								</div>
							</div>
						</div>
						@endif 
						@endfor

						{{-- for children --}}

						@for( $j = 0 ; $j< $children; $j++)

						@php
						$childage = $guest['childage']
						@endphp
								<h6>Child {{$j+1}} </h6>
							<div class="row">		
								
								<input type="hidden" name="guest[{{$index}}][child][{{$j}}][room]" id="" readonly value="{{$index+1}}">	
                                <div class="col-sm-2">
								<div class="form-group">
									<label>Title</label>
									<select name="guest[{{$index}}][child][{{$j}}][title]" class="form-control" id="" required>
                                         <option value="Title" disabled selected>Title</option>
                                        <option value="Mr.">Mr</option>
                                        <option value="Ms">Ms</option>
                                       
                                    </select>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>First name</label>
									<input type="text" class="form-control" id="firstname_booking" name="guest[{{$index}}][child][{{$j}}][firstname]" required minlength="3">
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>Last name</label>
									<input type="text" class="form-control" id="lastname_booking" name="guest[{{$index}}][child][{{$j}}][lastname]" required>
								</div>
							</div>
                            <div class="col-sm-2">
								<div class="form-group">
									<label>Age</label>
									<input type="number" class="form-control" id="" name="guest[{{$index}}][child][{{$j}}][age]" required value="{{$childage[$j]}}" readonly>
								</div>
							</div>
						</div>
						@endfor

						{{-- children ends --}}
						</div>
						<hr>
						@endforeach
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
										<select class="wide add_bottom_15 selectize-country-cart" name="country" id="country" required>
											<option value="">Select your country</option>

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

						@foreach($roomdetails as $index => $roomdetail )
						
						<h5>Room
							@if( session('searchData.rooms') > 1 )
							{{$index + 1 }}
							@endif
							Details</h5>
						<div class="row">
							
							<h6><u>Suppliments</u> </h6>
							<div class="col-md-12">
								<p>To be paid directly at the hotel on arrival</p>
								@if( isset($roomdetail['Supplements'] ))
							@forelse( $roomdetail['Supplements'] as $suppliment)
							<p>* {{$suppliment['SuppName']}} - {{$suppliment['CurrencyCode']}} {{$suppliment['Price']}}</p>
							@empty

							@endforelse
							
							@else 
								<p>* No Additional Costs</p>
							@endif
							</div>
							
						</div>

						<div class="row">
							<h6><u>Cancellation Policy</u> </h6>

							<div class="col-md-12">
								<table class="table table-bordered">
								<th>From</th>
								<th>To</th>
								<th>charges</th>
								<tr>
									<td>{{\Carbon\Carbon::parse($roomdetail['CancelPolicies']['CancelPolicy']['FromDate'])->format('d-m-Y')}} </td>
									<td>{{\Carbon\Carbon::parse($roomdetail['CancelPolicies']['CancelPolicy']['ToDate'])->format('d-m-Y')}} </td>
									@if( $roomdetail['CancelPolicies']['CancelPolicy']['ChargeType'] == 'Fixed' ) 
									<td>{{$roomdetail['CancelPolicies']['CancelPolicy']['Currency']}} {{$roomdetail['CancelPolicies']['CancelPolicy']['CancellationCharge']}}</td>
									@else 
									<td>{{$roomdetail['CancelPolicies']['CancelPolicy']['CancellationCharge']}} %</td>
									@endif
								</tr>
							</table>
							<p>{{$roomdetail['CancelPolicies']['DefaultPolicy']}}</p>
							</div>
							
						</div>

						<div class="row">
							<h6><u>Room Details</u> </h6>
							<div class="col-md-12 roomdetails">
								{!! $roomdetail['RoomAdditionalInfo']['Description'] !!}
							</div>
							
						</div>

						<div class="row">
							<h6><u>Amenities</u> </h6>
							<div class="row">
								@php $amenities = explode("|", $roomdetail['Amenities'] ); @endphp
								@foreach( $amenities as $amenity)
								<div class="col-md-3"> * {{$amenity}} </div>
								@endforeach
							</div>
						</div>
						<hr>
						@endforeach

					</div>
					<!-- /col -->
					
					<aside class="col-lg-3" id="sidebar">
						<div class="box_detail">
							<div id="total_cart">
								Total <span class="float-right">{{$price }} AED </span>
							</div>
							<ul class="cart_details">
								<li>From <span>{{\Carbon\Carbon::parse(session('searchData.CheckInDate'))->format('d-m-Y')}}</span></li>
								<li>To <span>{{\Carbon\Carbon::parse(session('searchData.CheckOutDate'))->format('d-m-Y')}}</span></li>
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
    <script src="{{ asset('js/selectize.js') }}"></script>

	 <script>
            $("#country").selectize({
                placeholder: 'Nationality'
                });
        </script>

</body>
@endsection
