@extends('frontend.layouts.frontend')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('flaticons/font/flaticon.css') }}">
@endsection

@section('content')
	<div id="page">
	<!-- /header -->	
	@include('frontend.layouts.navbar')  
	<!-- /header -->
	
	<main>
		<section class="hero_in hotels_detail">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>{{$hotel->HName}}</h1>
				</div>
				<span class="magnific-gallery">
					
					<a href="{{$hotel->Image}}" class="btn_photos" title="Photo title" data-effect="mfp-zoom-in">View photos</a>
					@foreach($hotel->images as $images)
					<a href="{{$images->link}}" title="Photo title" data-effect="mfp-zoom-in"></a>
					@endforeach
				</span>
			</div>
		</section>
		<!--/hero_in-->

		<div class="bg_color_1">
			<nav class="secondary_nav sticky_horizontal">
				<div class="container">
					<ul class="clearfix">
						<li><a href="#description" class="active">Description</a></li>
						<li><a href="#reviews">Reviews</a></li>
						<li><a href="#sidebar">Booking</a></li>
					</ul>
				</div>
			</nav>
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-9">
						<section id="description">
							<h2>Description</h2>
                            <div class="row">
							
							</div>
							<!-- /row -->
							<hr>
							<table class="table table-bordered table-responsive-md">
							<thead>
								<tr>
									<th></th>
									<th>Room Type</th>
									<th>Capacity</th>
									<th>Price</th>
									<th>Details</th>
									<th>Rooms</th>
									<th></th>
									
								</tr>
							</thead>
							<tbody>

                            @foreach($prebook as $room)	

							{{-- Price Calculation --}}
							@php
							if(isset($room['Amount']) )
							{
$price = ceil( $room['Amount'] +  20%($room['Amount']));
							}
							else{
								$price = 'NA';
							}
								
							@endphp
							
							@if(isset($room['RoomDetails']))
								<tr>
									<td><i class="flaticon flaticon-bed text-black text-4xl" style="color: black; font-size:40px;"></i></td>
									<td>{{$room['RoomDetails'][0]['RoomCategory']}}</td>
									<td>2</td>
									<td class="text-danger font-weight-bold ">{{$currency ?? 'AED'}} {{ number_format($price,2)}}</td>
									<td>
										<p><b> Meal: {{$room['RoomDetails'][0]['Meal']}} </b></p>
										<div class="d-sm-none d-md-block format-policy"> 
											<p><b> Policy </b></p>
											<p>
											@foreach($room['Policies'] as $policy)
											{!!$policy['Remark']!!}.
											@if(isset($policy['Offers'] ))
											offers:  {{$policy['Offers']}} ,
											@endif
											</p>
										</div>
											<p>
											@if(isset( $policy['CancellationPolicy']) ) 
											cancellation: AED {{$policy['CancellationPolicy'][0]['Amount']}} (from {{$policy['CancellationPolicy'][0]['FromDate']}} to  {{$policy['CancellationPolicy'][0]['ToDate']}}, Type:  {{$policy['CancellationPolicy'][0]['PolicyType']}} )
											@endif
											@endforeach
										</p>
										
										
									</td>
									<td>
										<select name="no_of_rooms" id="no_of_rooms_{{$loop->iteration}}">
											<option value="1" selected>1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
										</select>
									</td>
									<td>
										<button type="button" data-selectid="no_of_rooms_{{$loop->iteration}}" data-roomdetails="{{json_encode($room)}}" data-price="{{$price}}" data-hcode="{{$hotel->HCode}}" data-hotelname="{{$hotel->HName}}" data-city="{{$hotel->city}}" class="add_top_30 btn_1 full-width purchase">Book Now</button>
									</td>
								</tr>
							@endif
							{{-- <div class="room_type  @if($loop->first) first @elseif($loop->iteration %2 == 0) gray  @elseif($loop->first)last @else first @endif">
								<div class="row">
									<div class="col-md-4">
										<img src="" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<h4>{{$room['RoomCategory']}}</h4>
										<p>{{$room['Meal']}}</p>
                                        <p>Cancellation Policy: </p>
										<ul class="hotel_facilities">
											<li><img src="img/hotel_facilites_icon_2.svg" alt="">Single Bed</li>
											<li><img src="img/hotel_facilites_icon_4.svg" alt="">Free Wifi</li>
											<li><img src="img/hotel_facilites_icon_5.svg" alt="">Shower</li>
											<li><img src="img/hotel_facilites_icon_7.svg" alt="">Air Condition</li>
											<li><img src="img/hotel_facilites_icon_8.svg" alt="">Hairdryer</li>
										</ul>
										@php
										$price = ceil( $room['Amount'] +  20%  ($room['Amount']));
										@endphp
                                        <div class="pull-right">
                                            <h4 class="btn btn-default" ><b> AED  {{$price }} </b> </h4>
                                        </div>                                        
                                        
										<button type="button" data-roomdetails="{{json_encode($room)}}" data-price="{{$price}}" data-hcode="{{$hotel->HCode}}" data-hotelname="{{$hotel->HName}}" data-city="{{$hotel->city}}" class="add_top_30 btn_1 full-width purchase">Book Now</button>
                                        
                                        
									</div>
								</div>
								<!-- /row -->
							</div> --}}
							<!-- /rom_type -->

                            @endforeach

							</tbody>
							</table>
							<hr>
							<h3>Location</h3>
							{{-- <div id="map" class="map map_single add_bottom_30"></div> --}}
							<!-- End Map -->
						</section>
						<!-- /section -->
					
						<hr>

							{{-- <div class="add-review">
								<h5>Leave a Review</h5>
								<form>
									<div class="row">
										<div class="form-group col-md-6">
											<label>Name and Lastname *</label>
											<input type="text" name="name_review" id="name_review" placeholder="" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Email *</label>
											<input type="email" name="email_review" id="email_review" class="form-control">
										</div>
										<div class="form-group col-md-6">
											<label>Rating </label>
											<div class="custom-select-form">
											<select name="rating_review" id="rating_review" class="wide">
												<option value="1">1 (lowest)</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5" selected>5 (medium)</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10 (highest)</option>
											</select>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Your Review</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-12 add_top_20">
											<input type="submit" value="Submit" class="btn_1" id="submit-review">
										</div>
									</div>
								</form>
							</div> --}}
					</div>
					<!-- /col -->
					
					<aside class="col-lg-3" id="sidebar">

						<form method="GET" action="{{route('hotelrack_search_submit')}}">
						@csrf
						<div class="box_detail booking">
                            <h5>Modify Search</h5>							
							<div class="form-group">
							<input class="form-control" type="text" placeholder="Hotel , city" name="hotel" required>
							<i class="icon_search"></i>
							</div>
							<div class="form-group input-dates">
								<input class="form-control" type="text" name="dates" placeholder="When.." required>
								<i class="icon_calendar"></i>
							</div>

							<div class="panel-dropdown">
								<a href="#">Guests <span class="qtyTotal">1</span></a>
								<div class="panel-dropdown-content right">
									<div class="qtyButtons">
										<label>Adults</label>
										<input type="text" name="adult" value="1">
									</div>
									<div class="qtyButtons">
										<label>Childrens</label>
										<input type="text" name="children" value="0">
									</div>
								</div>
							</div>

							<input type="submit" class="btn_1 full-width outline wishlist" value="Search">	
						</form>
							
						</div>
						{{-- <ul class="share-buttons">
							<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
							<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
							<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
						</ul> --}}
					</aside>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->

	<!--Modal for user details -->


	<div class="modal fade" style="padding-top: 100px" id="userdetaisModal" tabindex="-1" role="dialog" aria-labelledby="userdetaisModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Submit Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{route('submit_interest_on_room')}}" id="interestform">
			@csrf
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control">
          </div>
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Phone:</label>
            <input type="text" name="phone" id="phone" class="form-control">
          </div>
		  <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email:</label>
            <input type="text" name="email" class="form-control">
          </div>
		  
            <input type="hidden" id="roomdetails" name="roomdetails" class="form-control">
			<input type="hidden" id="hotelcode" name="hotelcode" class="form-control">
			<input type="hidden" id="hotelname" name="hotelname" class="form-control">
			<input type="hidden" id="price" name="price" class="form-control">
			<input type="hidden" id="city" name="city" class="form-control">
			<input type="hidden" id="no_of_rooms_selected" name="no_of_rooms_selected" class="form-control">			
          
          <div class="form-group">
            <label for="message-text" class="col-form-label">Special Requests:</label>
            <textarea class="form-control" id="message-text" name="specialrequest"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="submitForm()" class="btn btn-primary">submit</button>
      </div>
    </div>
  </div>
</div>

	<!--Modal for user details End -->



    <!--Footer-->
	 @include('frontend.layouts.footer')
    <!--Footer-->

	</div>
	<!-- page -->

 <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>

     <script src="{{ asset('js/intlTelInput.js') }}" ></script>
	   <script src="{{ asset('js/utils.js') }}" ></script>
	   <script src="{{asset('js/input_qty.js')}}"></script>


   	<!-- DATEPICKER  -->
	<script>
	$(function() {
	  $('input[name="dates"]').daterangepicker({
		  autoUpdateInput: false,
		  parentEl:'.scroll-fix',
		  minDate:new Date(),
		  opens: 'left',
		  locale: {
			  cancelLabel: 'Clear'
		  }
	  });
	  $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format('MM-DD-YY'));
	  });
	  $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
		  $(this).val('');
	  });
	});
	</script>
	
	
	
	<!-- INSTAGRAM FEED  -->
	<script>
	// $(window).on('load', function(){
	// 		"use strict";
	// 		$.instagramFeed({
	// 			'username': 'hotelwailea',
	// 			'container': "#instagram-feed-hotel",
	// 			'display_profile': false,
	// 			'display_biography': false,
	// 			'display_gallery': true,
	// 			'get_raw_json': false,
	// 			'callback': null,
	// 			'styling': true,
	// 			'items': 12,
	// 			'items_per_row': 6,
	// 			'margin': 1 
	// 		});
	// 	});
	</script>

	<script>
		$(".purchase").on('click',function(){
		

			$("#roomdetails").val(JSON.stringify($(this).data('roomdetails')));
			$("#hotelcode").val($(this).data('hcode'));
			$("#hotelname").val($(this).data('hotelname'));
			$("#price").val($(this).data('price'));
			$("#city").val($(this).data('city'));
			// for selected rooms

			id = $(this).data('selectid');
			value = $('#'+id).val();
			$("#no_of_rooms_selected").val(value);

			$('#userdetaisModal').modal('show');
		})


		function submitForm()
		{
			$("#interestform").submit();
		}
	</script>

	@if(Session::has('success'))
	<script>

		alert('Thank you. Our agent will contact you shortly');
	</script>
	@endif



	 <!-- phone -->
    <script>
        var phone = document.querySelector("#phone");
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        var iti = window.intlTelInput(phone, {
            utilsScript: "{{asset('js/utils.js')}}",
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
	
	


@endsection