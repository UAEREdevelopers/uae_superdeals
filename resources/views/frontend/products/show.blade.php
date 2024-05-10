@extends('frontend.layouts.frontend')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('flaticons/font/flaticon.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        .hero_in.hotels_detail:before,
        .hero_in.hotels:before {
            background: url({{ $settings->categories_banner ?? '/img/home_section_1.jpg' }}) center center no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

    </style>

@endsection

@section('content')
    <div id="page">
        <!-- /header -->
        @include('frontend.layouts.navbar')
        
        <!-- /header -->

        <main id="content">

 @if ($product->media_gallery)
                            
                               
                                   
                                   
                                            
                                   
                                   
                                
                            
                            

            <section class="slider">
                <div id="slider" class="flexslider">
                    <ul class="slides">
                        @foreach ( $product->media_gallery as $gallery )
                            <li>
                                <img src="{{ asset($gallery->media) }}" alt="">
                                
                            </li>
                        @endforeach
                        
                    </ul>
                    <div id="icon_drag_mobile"></div>
                </div>
                <div id="carousel_slider_wp">
                    <div id="carousel_slider" class="flexslider">
                        <ul class="slides">
                            @foreach ( $product->media_gallery as $gallery )
                                <li>
                                    <img src="{{ asset($gallery->media) }}" alt="">
                                    
                                </li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>
		    </section>
             @endif
            <div class="bg_color_1">
			<style>
                .pictures_grid {
	margin-bottom: 45px
}

.pictures_grid figure {
	margin: 10px;
	overflow: hidden;
	position: relative;
	height: 120px;
	width: 120px;
	display: inline-block
}

@media (max-width:767px) {
	.pictures_grid figure {
		width: 80px;
		height: 80px
	}
}

.pictures_grid figure a {
	display: block
}

.pictures_grid figure a span {
	display: block;
	width: 100%;
	height: 100%;
	position: absolute;
	top: 0;
	left: 0;
	z-index: 9;
	background-color: #000;
	background-color: rgba(0, 0, 0, .7);
	color: #fff;
	font-size: 26px;
	font-size: 1.625rem
}

.pictures_grid figure a img {
	position: absolute;
	left: 50%;
	top: 50%;
	-webkit-transform: translate(-50%, -50%) scale(1);
	-moz-transform: translate(-50%, -50%) scale(1);
	-ms-transform: translate(-50%, -50%) scale(1);
	-o-transform: translate(-50%, -50%) scale(1);
	transform: translate(-50%, -50%) scale(1);
	-webkit-backface-visibility: hidden;
	-moz-backface-visibility: hidden;
	-ms-backface-visibility: hidden;
	-o-backface-visibility: hidden;
	backface-visibility: hidden;
	width: auto;
	height: 120px;
	z-index: 1;
	-moz-transition: all .3s ease-in-out;
	-o-transition: all .3s ease-in-out;
	-webkit-transition: all .3s ease-in-out;
	-ms-transition: all .3s ease-in-out;
	transition: all .3s ease-in-out
}

@media (max-width:767px) {
	.pictures_grid figure a img {
		height: 80px
	}
}

.pictures_grid figure a:hover img {
	-webkit-transform: translate(-50%, -50%) scale(1.05);
	-moz-transform: translate(-50%, -50%) scale(1.05);
	-ms-transform: translate(-50%, -50%) scale(1.05);
	-o-transform: translate(-50%, -50%) scale(1.05);
	transform: translate(-50%, -50%) scale(1.05)
}

            </style>
			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
							<h2>{{$product->name}}</h2>
                            
                            
							    
							    
							    {{-- <figure>
                                    <a href="{{ asset('images/iqibla/3.png') }}" title="Photo title" data-effect="mfp-zoom-in">
                                        <span class="d-flex align-items-center justify-content-center">+10</span>
                                        <img src="{{ asset('images/iqibla/3.png') }}" alt="">
                                    </a>
                                </figure> --}}
							
							<div class="container">
                                <div class="row">
                                    <section id="description" class="px-4 text-justify">
                                        <h4></h4>
                                        <div class="row pt-4" style="font-size: 16px">
                                            <div class="col-md-12">
                                                {!!$product->description!!}   
                                            </div>
                                        </div>  
                                        @if ($product->media_gallery)
                            <div class="pictures_grid magnific-gallery clearfix">
                                @foreach ( $product->media_gallery as $gallery )
                                    <figure>
                                        <a href="{{ asset($gallery->media) }}" title="{{$product->name}}" data-effect="mfp-zoom-in">
                                            <img src="{{ asset($gallery->media) }}" alt="">
                                        </a>
                                    </figure>
                                @endforeach
                            </div>
                            @endif
                                        @if($product->media_content)
                                            @foreach ($product->media_content as  $media)
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    @if ($media->type=='video')
                                                        <video src="{{ asset($media->media) }}" autoplay muted width="100%"
                                                        height="auto"></video>
                                                    @else
                                                        <img src="{{ asset($media->media) }}" alt="" class="img-fluid">
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                                 <!-- /row -->
                                    </section>
                                </div>
                            </div>
							
							
							
						</section>
						<!-- /section -->
					
						
                    </div>
					<!-- /col -->
					
					<aside class="col-lg-4" id="sidebar">
						<div class="box_detail booking">
							<div class="price">
								<h5 class="d-inline">{{$product->price}} AED</h5>
								<div class="score"></div>
							</div>
							<div id="message-contact-detail"></div>
							{{-- <form method="post" action="{{route('add_to_cart_product') }}" id="contact_detail" autocomplete="off"> --}}
                            <form method="POST" action="{{route('add_to_cart_product') }}" id="add_to_cart" autocomplete="off">
                                <input type="hidden" name="sku" value="{{$product->sku}}">
                                        <input type="hidden" name="product" value="{{$product->name}}">
                                        <input type="hidden" name="price" value="{{$product->price}}">
                                @csrf
								<div class="form-group">
									<input  type="number" class="form-control" step="1" min="0" max="10" name="qty" value ="1" placeholder="Qty">
									
								</div>
								<div class="form-group">
                                    <select name="size" id="" class="form-control" id="message_detail">
                                    <option value="0" selected disabled>Size</option>
                                    <option value="18mm">18 mm</option>
                                    <option value="20mm">20 mm</option>
                                    <option value="22mm">22 mm</option>
                                </select>
									
								</div>
								
								<div class="form-group">
									<input type="submit" value="Add To Cart" class="add_top_30 btn_1 full-width purchase" id="submit-contact-detail">
								</div>
								
							</form>
						</div>
						
					</aside>
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
    <script src="{{ asset('js/common_scripts.js') }}"></script>
    <script src="{{ mix('js/themescripts.js') }}"></script>

    <script src="{{ asset('js/intlTelInput.js') }}"></script>
    <script src="{{ asset('js/utils.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>


    <script>
        $(document).ready(function() {

            $("#product-slider").owlCarousel({


                slideSpeed: 200,
                paginationSpeed: 100,
                loop: true,
                items: 1,
                autoplay: true,
                autoplayHoverPause: true

            });

        });
    </script>

    @if (Session::has('success'))
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


    <!-- FlexSlider -->
	<script defer src="{{ asset('js/jquery.flexslider.js') }}"></script>
	<script>
		$(window).on('load', function(){
			'use strict';
			$('#carousel_slider').flexslider({
				animation: "slide",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				itemWidth: 280,
				itemMargin: 25,
				asNavFor: '#slider'
			});
			$('#slider').flexslider({
				animation: "fade",
				controlNav: false,
				animationLoop: false,
				slideshow: false,
				sync: "#carousel_slider",
				start: function(slider) {
					$('body').removeClass('loading');
				}
			});
		});
	</script>	




@endsection
