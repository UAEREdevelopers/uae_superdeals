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
		@php
					$images = json_decode($hotel->images, true);
				@endphp

		<section class="hero_in hotels_detail" style="background-image: url({{$images[0]}})">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>{{$hotel->HotelName}}</h1>
				</div>
				
				<span class="magnific-gallery">
				<a href="{{$images[0]}}" class="btn_photos" title="" data-effect="mfp-zoom-in">View photos</a>
					@foreach($images as $image)
					<a href="{{$image}}" title="" data-effect="mfp-zoom-in"></a>
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
					<div class="col-lg-8">
						<section id="description">
							<h2>Description</h2>
                            <div class="row">
								{{$hotel->Description}}
							</div>
							<!-- /row -->
							<hr>
							@if($result['status']['statusCode'] == 01)
							<table class="table table-bordered table-responsive-md">
							<thead>
								<tr>
									<th></th>
									<th>Room Details </th>
									{{-- <th>Price</th>
									<th>Details</th> --}}
									<th></th>
									
								</tr>
							</thead>
							<tbody>
                            @forelse($data as $index => $combinations)	
							
							@php
							$price = 0 ; 
							$RoomIndex = []; 
							$currency  = $combinations[0]['RoomRate']['PrefCurrency'] ;
							@endphp
								<tr>
									<td><i class="flaticon flaticon-bed text-black text-4xl" style="color: black; font-size:40px;"></i></td>
									@foreach($combinations as $room  )

									@php 
									$RoomIndex[] = $room['RoomIndex'] ;
									$price =  $price +  number_format(getAmountWithCommission($room['RoomRate']['PrefPrice']),2) ; 
									@endphp
									<td>
										<span style="font-weight: 600">{{$room['RoomTypeName']}}</span>, Price: {{$currency ?? $room['RoomRate']['PrefCurrency'] }} {{ number_format(getAmountWithCommission($room['RoomRate']['PrefPrice']),2)}}
											<p>{{$room['Inclusion']}}</p>
											<p>Meal: {{$room['MealType']}}</p>
										</td>
									{{-- <td><i class="flaticon flaticon-bed text-black text-4xl" style="color: black; font-size:40px;"></i></td>
									<td><span style="font-weight: 600">{{$room['RoomTypeName']}}</span>
										<p>{{$room['Inclusion']}}</p>
								
								</td>
									
									<td class="text-danger font-weight-bold ">{{$currency ?? $room['RoomRate']['PrefCurrency'] }} {{ number_format(getAmountWithCommission($room['RoomRate']['PrefPrice']),2)}}</td>
									<td>
										<p>Meal: {{$room['MealType']}}</p>
										
									</td>
									<td>
										<button type="button" data-selectid="no_of_rooms_{{$loop->iteration}}" data-roomdetails="{{json_encode($room)}}" 
											data-ResultIndex="{{$result['ResultIndex']}}" data-RoomIndex="{{$room['RoomIndex']}}" data-sessionid="{{session('sessionId')}}"
											data-price="{{number_format(getAmountWithCommission($room['RoomRate']['PrefPrice']),2)}}" data-hotelcode="{{$hotel->HotelCode}}" data-hotelname="{{$hotel->HotelName}}" data-city="{{$hotel->CityName}}" class="add_top_30 btn_1 full-width checkAvailability">Book Now</button>
									</td> --}}

									@endforeach
									
									@php $roomindex = implode( ',', $RoomIndex	);  @endphp
									<td><p>{{$currency}} {{number_format($price,2) }} </p></td>
									<td><button data-roomdetails="{{json_encode($combinations)}}"   data-price="{{number_format(getAmountWithCommission($price))}}" data-ResultIndex="{{$result['ResultIndex']}}"  data-roomindex="{{$roomindex}}" data-sessionid="{{session('sessionId')}}" data-hotelcode="{{$hotel->HotelCode}}" data-hotelname="{{$hotel->HotelName}}" data-city="{{$hotel->CityName}}"  class="btn_1 checkAvailability" >select</button></td>
								</tr>
							<!-- /rom_type -->
							@empty
							No Results found
                            @endforelse
							</tbody>
							</table>
							@else
							No Results found
							@endif

							{{-- <h3>Location</h3>
							<div id="map" class="map map_single add_bottom_30"></div> --}}
							<!-- End Map -->
						</section>
						<!-- /section -->
						
					</div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">

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

	<!--Modal to show Cancellation Policies before booking -->

	<div class="modal fade" style="padding-top: 100px" data-backdrop="static" data-keyboard="false" id="hotelpolicies" tabindex="-1" role="dialog" aria-labelledby="hotelpoliciesModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hotel Policies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
		  <button type="button" onclick="submitForm()" class="btn_1 pull-right agreebtn">Agee & Book </button>
		  <div class=""  id="policydetails">
			Loading...
		  </div>
		

		<form method="POST" action="{{route('submit_interest_on_room_tbo')}}" id="interestform">
			@csrf

			<input type="hidden" name="roomdetails" id="roomdetails">
			<input type="hidden" name="ResultIndex" id="ResultIndex">
			<input type="hidden" name="roomIndex" id="roomIndex">
			<input type="hidden" name="price" id="price">
			<input type="hidden" name="sessionId" id="sessionId">
			<input type="hidden" name="HotelCode" id="hotelcode">
			<input type="hidden" name="HotelName" id="hotelname">
			<input type="hidden" name="city" id="city">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="submitForm()" class="btn_1 agreebtn">Agee & Book </button>
      </div>
    </div>
  </div>
</div>

	<!--Modal to show Cancellation Policies before booking Ends -->

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

	<script>
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
	$('.checkAvailability').on('click',function(){
			$('.agreebtn').attr('disabled','disabled');
		// $('.agreebtn').prop('disbled',true);
		$('#policydetails').html("<p>Loading... </p>");

		$('#hotelpolicies').modal('show');
		var details =JSON.stringify($(this).data('roomdetails'));
		var roomIndex = $(this).data('roomindex');
		var ResultIndex = $(this).data('resultindex');
		var SessionId = $(this).data('sessionid');
		var price = $(this).data('price');
		var hotelcode = $(this).data('hotelcode');
		var hotelname = $(this).data('hotelname');
		var city = $(this).data('city');

		// assigning values
		$('#roomdetails').val(details);
		$('#sessionId').val(sessionId);
		$('#ResultIndex').val(ResultIndex);
		$('#roomIndex').val(roomIndex);
		$('#price').val(price);
		$('#hotelcode').val(hotelcode);
		$('#hotelname').val(hotelname);
		$('#city').val(city);


		$.ajax({
               type:'POST',
               url:"{{route('check_availability')}}",
               data:{
				    "_token": "{{ csrf_token() }}",'roomIndex': roomIndex ,'ResultIndex' :ResultIndex , 'SessionId': SessionId
			   }, 
               success:function(data) {
				   $('.agreebtn').removeAttr('disabled');
				   var text = "<p>";	
				   console.log(data);
						if(data.status.statusCode == '01'){
							

							for (let i = 0; i < data.HotelNorms.length; i++) {
								text += data.HotelNorms[i] + "<br>";
								}
								text +="</p>";
								text +="<h5>Cancellation Policies</h5><p>";
								text += data.CancelPolicies.AutoCancellationText;	
								text += data.CancelPolicies.DefaultPolicy;
								text += data.CancelPolicies.LastCancellationDeadline;
								text +="</p><p>";
								for (let i = 0; i < data.CancelPolicies.CancelPolicy.length; i++) {
								text +="From "+ data.CancelPolicies.CancelPolicy[i].FromDate + " ";
								text +="To "+ data.CancelPolicies.CancelPolicy[i].ToDate + " ";
								text +="Cancellation Charge of "+ data.CancelPolicies.CancelPolicy[i].CancellationCharge + " ";
								text += data.CancelPolicies.CancelPolicy[i].ChargeType + " in ";
								text += data.CancelPolicies.CancelPolicy[i].Currency + "<br>";	
								}
						
				 		  
						}else{
							text+="Something went wrong. Please search Again.</p>"
						}


						$('#policydetails').html(text);
							
				
				//    $('.loader_'+id).hide();		 
				// 	$("#row").css({height: 'auto'});
                //   $("#details_"+id).html(data.Policies[0].Remark);
               }
            });


	});
</script>
	
	


@endsection