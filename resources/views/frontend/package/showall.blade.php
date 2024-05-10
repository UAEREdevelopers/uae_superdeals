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
					<h1 class="fadeInUp"><span></span>Packages</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->
		
		<div class="filters_listing sticky_horizontal d-none d-lg-block">
			<div class="container">
				<ul class="clearfix">
					<li>
						<div class="switch-field">
							{{-- <input type="radio" id="all" name="listing_filter" value="all" checked data-filter="*" class="selected">
							<label for="all">All</label>
							<input type="radio" id="popular" name="listing_filter" value="popular" data-filter=".popular">
							<label for="popular">Popular</label>
							<input type="radio" id="latest" name="listing_filter" value="latest" data-filter=".latest">
							<label for="latest">Latest</label> --}}
						</div>
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
			{{-- <div class="col-lg-12">
				<div class="row no-gutters custom-search-input-2 inner">
					<div class="col-lg-4">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="What are you looking for...">
							<i class="icon_search"></i>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="form-group">
							<input class="form-control" type="text" placeholder="Where">
							<i class="icon_pin_alt"></i>
						</div>
					</div>
					<div class="col-lg-3">
						<select class="wide">
							<option>All Categories</option>	
							<option>Churches</option>
							<option>Historic</option>
							<option>Museums</option>
							<option>Walking tours</option>
						</select>
					</div>
					<div class="col-lg-2">
						<input type="submit" class="btn_search" value="Search">
					</div>
				</div>
				<!-- /row -->
			</div> --}}
			<!-- /custom-search-input-2 -->
			
			<div class="isotope-wrapper">
			<div class="row">

                @forelse ($packages as $package)
                    <div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
					<div class="box_grid">
                            <figure>
                                {{-- <a href="#" class="wish_bt"></a> --}}
                                <a href="{{route('show_package',['id'=>$package->slug])}}"><img src="{{$package->thumbnail_image}}" class="img-fluid" alt="" width="800" height="533">
                                    <div class="read_more"><span>Read more</span></div>
                                </a>
                                {{-- <small></small> --}}
                            </figure>
                            <div class="wrapper">
                                <h3><a href="{{route('show_package',['id'=>$package->slug])}}">{{$package->title}}</a></h3>
                                <p>{!!$package->short_description!!}</p>
                                <span class="price">From <strong>AED {{number_format($package->package_price,2)}}</strong></span>
                            </div>
                            <ul>
                                {{-- <li><i class="icon_clock_alt"></i></li> --}}
                                <li>
                                    {{-- <div class="score"><span>Superb<em>350 Reviews</em></span><strong>8.9</strong></div>  --}}
                                </li>
                            </ul> 
                        </div>
				</div>
				<!-- /box_grid -->
                @empty
                    
                @endforelse
			</div>
			<!-- /row -->
			</div>
			<!-- /isotope-wrapper -->
			
			{{-- <p class="text-center"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p> --}}
            	{{ $packages->links() }}
			
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

   <!-- Map -->
	{{-- <script src="http://maps.googleapis.com/maps/api/js"></script>
	<script src="js/markerclusterer.js"></script>
	<script src="js/map_hotels.js"></script>
	<script src="js/infobox.js"></script> --}}
	
	<!-- Masonry Filtering -->
	{{-- <script src="js/isotope.min.js"></script> --}}
	<script>
	$(window).on('load', function(){
	  var $container = $('.isotope-wrapper');
	  $container.isotope({ itemSelector: '.isotope-item', layoutMode: 'masonry' });
	});

	$('.filters_listing').on( 'click', 'input', 'change', function(){
	  var selector = $(this).attr('data-filter');
	  $('.isotope-wrapper').isotope({ filter: selector });
	});
	</script>
@endsection