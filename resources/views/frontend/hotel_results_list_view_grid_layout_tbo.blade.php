@extends('frontend.layouts.frontend')

@section('content')
	<div id="page">
	<!-- /header -->	
	@include('frontend.layouts.navbar')  
	<!-- /header -->
	
	<main>
		
		<section class="hero_in hotels">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>Search Result</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->
		
		<div class="filters_listing sticky_horizontal d-none d-lg-block">
			<div class="container">
				<ul class="clearfix">
					<li>
						{{-- <div class="switch-field">
							<input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*" class="selected">
							<label for="all">All</label>
							<input type="radio" id="popular" name="listing_filter" value="Lowest Price" data-filter=".popular">
							<label for="popular">Popular</label>
							<input type="radio" id="latest" name="listing_filter" value="Highest Price" data-filter=".latest">
							<label for="latest">Latest</label>
						</div> --}}
					</li>
					<li>
						<div class="layout_view">
							<a href="hotels-grid-isotope.html"><i class="icon-th"></i></a>
							<a href="#0" class="active"><i class="icon-th-list"></i></a>
						</div>
					</li>
					{{-- <li>
						<a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
					</li> --}}
				</ul>
			</div>
			<!-- /container -->
		</div>
		<!-- /filters -->
		
		<div class="collapse" id="collapseMap">
			<div id="map" class="map"></div>
		</div>
		<!-- End Map -->

		<div class="container margin_60_35">
			<div class="row">
				<aside class="col-lg-3">
					<div class="sticky-top" style="top: 150px">
						{{-- <form method="GET" action="{{route('hotelrack_search_submit')}}">
						@csrf
					<div class="custom-search-input-2 inner-2">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="Hotel , city" name="hotel" required>
							<i class="icon_search"></i>
						</div>
						<div class="form-group">
							<input class="form-control" type="text" name="dates" placeholder="When..">
							<i class="icon_pin_alt"></i>
						</div>
					
						
                              
						<div class="form-group">
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
						</div>
						<div class="form-group">
							<select class="form-control" name="nationality" id="">
								<option data-display="Nationality">Nationality</option>
								@foreach($countries as $country)
								<option value="{{$country->CountryId}}">{{$country->Country}}</option>
								@endforeach
							</select>                                        
						</div>
                         
            
						<input type="submit" class="btn_search" value="Search">
					</div>
					   </form> --}}

					   
					   
					<!-- /custom-search-input-2 -->
					<div id="filters_col">
						<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
						<div class="collapse show" id="collapseFilters">							
							<div class="filter_type">
								<h6>Sort by Star Rating</h6>
								<ul>
									<li>
										<label><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'star', 'value' => 'All']) }}">All</label></a></small></label>
										{{-- <input type="checkbox" class="js-switch" checked> --}}
									</li>
									<li>
										<label><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price', 'value' => 'FourStarOrMore']) }}">4 star or above</label></a></small></label>
										{{-- <input type="checkbox" class="js-switch"> --}}
									</li>
									<li>
										<label><span class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></span> <small><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price', 'value' => 'ThreeStarOrLess']) }}">3 Star or Below</label></a></small></label>
										{{-- <input type="checkbox" class="js-switch"> --}}
									</li>
								</ul>
							</div>
							<div class="filter_type">
								<h6>Sort by Price</h6>
								<div class="switch-field d-flex justify-content-between">
									<div><label for="all"><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price', 'value' => 'PriceAsc']) }}">All</label></a></div>
									<div><label for="popular"><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price', 'value' => 'PriceAsc']) }}">Lowest</label></a></div>
									<div><label for="latest"><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price', 'value' => 'PriceDesc']) }}">Highest</label></a></div>
									
							{{-- <input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*" class="selected">
							<label for="all">All</label>
							<input type="radio" id="popular" name="listing_filter" value="Lowest Price" data-filter=".popular">
							<label for="popular"><a href="{{ request()->fullUrlWithQuery(['sorttype' => 'price'], 'value' => 'PriceAsc') }}">Lowest</a> </label>
							<input type="radio" id="latest" name="listing_filter" value="Highest Price" data-filter=".latest">
							<label for="latest">Highest</label> --}}
						</div>
							</div>
						</div>
						<!--/collapse -->
					</div>
					<!--/filters col-->
					</div>
				</aside>
				<!-- /aside -->

				<div class="col-lg-9" id="list_sidebar">
					<div class="isotope-wrapper">
						<div class="row">
							@foreach($hotels as $hotel)
							<div class="col-md-6 isotope-item popular">
								<div class="box_grid">
									<figure>
										<a href="{{route('hotel_detail_view_tbo', ['id' => $hotel['HotelCode'], 'resultindex' => $hotel['ResultIndex']])}}" class="wish_bt show-loading"></a>
										<a href="{{route('hotel_detail_view_tbo', ['id' => $hotel['HotelCode'], 'resultindex' => $hotel['ResultIndex']])}}"><img src="{{$hotel['HotelPicture']}}" class="img-fluid show-loading" alt="" width="800" height="533"><div class="read_more"><span>Read more</span></div></a>
										<small>Historic</small>
									</figure>
									<div class="wrapper">
										<h3><a href="{{route('hotel_detail_view_tbo', ['id' => $hotel['HotelCode'], 'resultindex' => $hotel['ResultIndex']])}}" class="show-loading">{{$hotel['HotelName']}}</a></h3>
										<p>{{$hotel['HotelAddress']}} </p>
										<span class="price">From <strong>{{$hotel['PrefCurrency']}} {{$hotel['PrefPrice']}}</strong> /per Room</span>
									</div>
									<ul>
										<li><i class="icon_clock_alt"></i> 1h 30min</li>
										<li><div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div></li>
									</ul>
								</div>
							</div>
							<!-- /box_grid -->
							 @endforeach

						</div>				
					</div>
					<!-- /isotope-wrapper -->

					
                   {{-- {{ $hotels->withQueryString()->onEachSide(5)->links() }} --}}

				   <div class="d-flex justify-content-center loading-div">
						{{ $hotels->withQueryString()->links('pagination::bootstrap-4') }}
					</div>
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->

		</div>
		<!-- /container -->
		<div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-md-4">
						<a href="#" class="boxed_list">
							<i class="pe-7s-help2"></i>
							<h4>Need Help? Contact us</h4>
							<p></p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-wallet"></i>
							<h4>No Cancellation charges*</h4>
							<p></p>
						</a>
					</div>
					<div class="col-md-4">
						<a href="#0" class="boxed_list">
							<i class="pe-7s-note2"></i>
							<h4>Assured Quality</h4>
							<p></p>
						</a>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /bg_color_1 -->
	</main>
	<!--/main-->

    <!--Footer-->
	 @include('frontend.layouts.footer')
    <!--Footer-->

	</div>
	<!-- page -->

 <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>
   <script src="{{asset('js/input_qty.js')}}"></script>
    <script src="{{ asset('js/selectize.js') }}"></script>

   <!-- Map -->
	{{-- <script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="js/markerclusterer.js"></script>
	<script src="js/map_hotels.js"></script>
	<script src="js/infobox.js"></script> --}}
	
	<!-- Masonry Filtering -->
	<script src="{{asset('js/isotope.min.js')}}"></script>
	{{-- <script>
	$(window).on('load', function(){
	  var $container = $('.isotope-wrapper');
	  $container.isotope({ itemSelector: '.isotope-item', layoutMode: 'masonry' });
	});

	$('.filters_listing').on( 'click', 'input', 'change', function(){
	  var selector = $(this).attr('data-filter');
	  $('.isotope-wrapper').isotope({ filter: selector });
	});
	</script> --}}
	
	<!-- Range Slider -->
	<script>
		 $("#range").ionRangeSlider({
            hide_min_max: true,
            keyboard: true,
            min: 30,
            max: 180,
            from: 60,
            to: 130,
            type: 'double',
            step: 1,
            prefix: "Min. ",
            grid: false
        });
	</script>

	 <script>
        $(document).ready(function(){      
            'use strict';
            $('input[name="dates"]').daterangepicker({
				maxSpan: {"days": 29},
                autoUpdateInput: false,
                minDate: new Date(),
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format('DD-MM-YYYY'));
            });
            $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>

 <script>
            var spinner = $('#loader');
            $('.show-loading').click(function(){
               spinner.show();
            });

			$('.loading-div>li').click(function(){
				spinner.show();
			});
        </script>


<script>
            $("#nationality").selectize({
                });
        </script>
@endsection