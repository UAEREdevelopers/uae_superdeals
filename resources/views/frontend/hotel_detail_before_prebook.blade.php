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
				<a href="{{$hotel->Image}}" class="btn_photos" title="" data-effect="mfp-zoom-in">View photos</a>
					@foreach($hotel->images as $images)
					<a href="{{$images->link}}" title="" data-effect="mfp-zoom-in"></a>
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
				<div class="row" id="row">
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

                            @foreach($hotelrooms as $room)						
								@php
														dd($room);
								@endphp
								<tr>
									<td><i class="flaticon flaticon-bed text-black text-4xl" style="color: black; font-size:40px;"></i></td>
									<td>{{$room['RoomCategory']}}
									
									<p><button class="btn" id="details_{{$loop->iteration}}" onclick="fetchdetails('{{$loop->iteration}}', '{{$hotel->HCode}}' , '{{$room['HKey']}}' , '{{$room['RateKey']}}')">View more Details
										 <span class="loader_{{$loop->iteration}}" style="display: none"><div class="spinner-border spinner-border-sm" role="status">
  <span class="sr-only">Loading...</span>
</div></span></button></p>
								
								</td>
									<td>2</td>
									<td class="text-danger font-weight-bold ">{{$currency ?? 'AED'}} {{ number_format(getAmountWithCommission($room['Amount']),2)}}</td>
									<td>
										<p>Meal: {{$room['Meal']}}</p>
										{{-- <p>Cancellation Policy:</p> --}}
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
							{{-- <h3>Location</h3>
							<div id="map" class="map map_single add_bottom_30"></div> --}}
							<!-- End Map -->
						</section>
						<!-- /section -->
						<hr>
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
                                        <div class="panel-dropdown-content">
                                            <!-- Quantity Buttons -->
                                            <div class="qtyButtons" data-type="adult">
                                                <label>Adults</label>
                                                <input type="text" name="adult" value="1">
                                            </div>
                                            <div class="qtyButtons" data-type="children">
                                                <label>Childrens <span style="display: block; font-size:10px; margin-top:-15px; color:black; font-weght:bolder">(Age 0 -12 yrs)</span></label>
                                                <input type="text" name="children" value="0">
                                                   
                                            </div>
                                        </div>
                                    </div>

							<div class="form-group">
                                      <select class="form-control d-block" name="nationality" id="" s>
                                           <option data-display="Nationality">Nationality</option>
                                          @foreach($countries as $country)
                                          <option value="{{$country->CountryId}}">{{$country->Country}}</option>
                                          @endforeach
                                      </select>                                        
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
		   maxSpan: {"days": 29},
		  autoUpdateInput: false,
		  parentEl:'.scroll-fix',
		  minDate:new Date(),
		  opens: 'left',
		  locale: {
			  cancelLabel: 'Clear'
		  }
	  });
	  $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
		  $(this).val(picker.startDate.format('MM-DD-YY') + ' to ' + picker.endDate.format('MM-DD-YY'));
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


<script>
	function fetchdetails(id, HCode, roomkey, ratekey)
	{	
		$('.loader_'+id).show();
		console.log(roomkey);
		console.log(ratekey);

		$.ajax({
               type:'POST',
               url:'/hr/fetchroominfo',
               data:{
				    "_token": "{{ csrf_token() }}",'RateKey': ratekey ,'HKey' :roomkey , 'HCode' : HCode
			   }, 
               success:function(data) {	
				   $('.loader_'+id).hide();		 
					$("#row").css({height: 'auto'});
                  $("#details_"+id).html(data.Policies[0].Remark);
               }
            });
	}
</script>
	
	


@endsection