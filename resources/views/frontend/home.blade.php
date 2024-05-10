@extends('frontend.layouts.frontend') @section('styles') <style>
        .typeahead.dropdown-menu {
            max-height: 230px;
            overflow-y: scroll;
        }

        .hero_single.version_2:before {
            background: url({{ $settings->home_banner ?? '/img/home_section_1.jpg' }}) center center no-repeat;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

    </style>
    @endsection @section('content')

    <body class="datepicker_mobile_full">

        <!-- Remove this class to disable datepicker full on mobile -->
        {{-- <div class="scroll-left">
		<p>Supedeals Best travel portal in the world</p>
	</div> --}}
        <div id="page">
            <!-- /header --> @include('frontend.layouts.navbar')
            <!-- /header -->
            <main>

                <section class="hero_single version_2">
                    <div class="wrapper">
                        <div class="container">
                            <h3 style="letter-spacing: 5px;">{{ $settings->banner_heading ?? ' ' }} </h3>
                            <p>
                                <span class="element" style="font-weight: 600"></span>
                            </p>
                            <form method="GET" action="{{ route('search_submit') }}" id="homesearch"> @csrf <div
                                    class="row no-gutters custom-search-input-2">
                                    <div class="col-lg-3">
                                        <div class="form-group" id="scrollable-dropdown-menu">
                                            <input class="form-control typeahead" name="hotel" type="text" id="searchbox"
                                                placeholder="Hotel, City..." required>
                                            <i class="icon_pin_alt"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="dates" placeholder="When.."
                                                required>
                                            <i class="icon_calendar"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-2" style="width: 100%">
                                        <div class="form-group">
                                            <select class="form-control" name="nationality" id="nationality">
                                                <option value="">Select your country</option>
                                                {{-- Countries passed from AppserviceProvider Globally --}} @foreach ($countries as $country) <option value="{{ $country->country_id }}">{{ $country->country_name }}</option> @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="panel-dropdown">
                                            <a href="#">Guests <span class="qtyTotal">1</span>
                                            </a>
                                            <div class="panel-dropdown-content">
                                                <!-- Quantity Buttons -->
                                                <div class="qtyButtons" data-type="adult">
                                                    <label>Adults</label>
                                                    <input type="text" name="adult" value="1">
                                                </div>
                                                <div class="qtyButtons" data-type="children">
                                                    <label>Childrens <span
                                                            style="display: block; font-size:10px; margin-top:-15px; color:black; font-weght:bolder">(Age
                                                            0 -12 yrs)</span>
                                                    </label>
                                                    <input type="text" name="children" value="0">
                                                </div>
                                                <div class="qtyButtons" data-type="rooms">
                                                    <label>Rooms</label>
                                                    <input type="text" name="rooms" value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <input type="submit" class="btn_search  text-uppercase show-loading" value="Search">
                                    </div>
                                </div>
                                <!-- /row -->
                            </form>
                        </div>
                    </div>
                </section>
        </div>
        <!-- /Background YouTube Parallax -->
        <div class="container container-custom margin_20_0 weekend-getaway-section">
            <div class="main_title_2">
                <h2 class=" homepage-title">
                    
                    <a
                        href="{{ route('show_category', ['category' => $packages['top_section']->first()->category->slug ?? '']) }}">{{ $packages['top_section']->first()->category->name ?? '' }}</a>
                </h2>
            </div>
            <div class="container d-none d-md-block d-lg-block  mb-2">
                <div class="d-flex justify-content-between text-center">
                    <div>
                        <img src="{{ asset('images/homepage/airplan-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Flights</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/hotel-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Hotels</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/bfast-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Meals</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/car-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Transportation</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/tour-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Tours</h5>
                    </div>
                </div>
            </div>

            <div class="owl-carousel owl-theme" id="reccomended">
                @forelse ($packages['top_section'] as $package)
                    <div class="item">
                        <div class="card fixed-height">
                            <a href="{{ route('show_package', ['id' => $package->slug]) }}">
                                <img src="{{ $package->thumbnail_image ?? asset('images/default-img.jpg')  }}" class="card-img-top"
                                    alt="{{ $package->title }}">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title weekend-getaway-section-title">{{ $package->title }}</h5>
                                <h4>Starting from <b>AED {{ number_format($package->package_price, 2) }}</b>
                                </h4>
                                <div class="d-flex justify-content-lg-between">
                                    <div>
                                        <p class="card-text">{!! $package->short_description !!}</p>
                                    </div>
                                    <div class="category-btn">
                                        <a href="{{ route('show_package', ['id' => $package->slug]) }}"
                                            class="btn ">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                @endforelse
            </div>
            <!-- /carousel -->
            <p class="btn_home_align">
                <a href="{{ route('show_category', ['category' => $packages['top_section']->first()->category->slug ?? '']) }}"
                    class="btn_1 rounded ">View all Tours</a>
            </p>
        </div>
        <!-- /container -->
        <div class="container-fluid margin_20_0 spcecial-tours-section"
            style="background: url({{ $settings->homepage_second_banner ?? asset('images/homepage-2.png') }}">
            <div class="main_title_2">
                <h2 class=" homepage-title">
                    <a
                        href="{{ route('show_category', ['category' => $packages['middle_section']->first()->category->slug ?? '']) }}">{{ $packages['middle_section']->first()->category->name ?? '' }}</a>
                </h2>
                {{-- <p>Packages with special prices to popular Destinations only for you</p> --}}
            </div>
            <div class="container d-none d-md-block d-lg-block  mb-2">
                <div class="d-flex justify-content-between text-center">
                    <div>
                        <img src="{{ asset('images/homepage/airplan-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Flights</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/hotel-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid text-xl-center">
                        <h5 class="text-center text-uppercase text-icon-fix">Hotels</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/bfast-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Meals</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/car-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Transportation</h5>
                    </div>
                    <div>
                        <img src="{{ asset('images/homepage/tour-red.png') }}" width="70px" height="auto" alt=""
                            class="image-fluid">
                        <h5 class="text-center text-uppercase text-icon-fix">Tours</h5>
                    </div>
                </div>
            </div>
            <div class="container py-2 my-2">
                <div class="row tours owl-carousel owl-theme" id="special-tours-section">

                    @forelse($packages['middle_section'] as $tour)
                        <a href="{{ route('show_package', ['id' => $tour->slug]) }}">
                            <div class="item tours-image">
                                <img src="{{ $tour->thumbnail_image ?? asset('images/default-img.jpg') }}" alt="">
                                <h5 class="text-center ">{{ $tour->title }}</h5>
                                {{-- <div class="centered-text "> {{ $tour->country }} </div> --}}
                            </div>
                        </a>
                    @empty
                    @endforelse
                </div>
            </div>
            <!-- /carousel -->
        </div>

        {{-- video ends --}}

        <!-- /container -->
        <div class="container container-custom margin_20_0 discover-uae-section">
            <div class="main_title_2">
                <h2 class=" homepage-title">
                    <a
                        href="{{ route('show_category', ['category' => $packages['bottom_section']->first()->category->slug ?? '']) }}">{{ $packages['bottom_section']->first()->category->name ?? '' }}</a>
                </h2>
                {{-- <p>Packages with special prices to popular Destinations only for you</p> --}}
            </div>

            <div class="row">
                @forelse($packages['bottom_section'] as $item)
                    <div class="col-md-5 @if ($loop->iteration % 2 != 0) offset-md-1 @endif pt-4">
                        <div class="card">
                            <div class="row no-gutters">
                                <div class="col-sm-7" style="background: #868e96;">
                                    <a href="{{ route('show_package', ['id' => $item->slug]) }}">
                                        <img src="{{ $item->thumbnail_image ??  asset('images/default-img.jpg')  }}" class="card-img-top fixed-height-image" alt=""
                                            width="100%" height="auto">
                                    </a>
                                </div>
                                <div class="col-sm-5">
                                    <div class="card-body">
                                        <h5 class="card-title  disco">{{ $item->title }}</h5>
                                        <p class="card-text">Only AED {{ $item->package_price }}
                                            <br>{!! $item->short_description !!}
                                        </p>
                                        <a href="{{ route('show_package', ['id' => $item->slug]) }}"
                                            class="btn stretched-link ">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
            <!-- /carousel -->
            <p class="btn_home_align">
                <a href="{{ route('show_category', ['category' => $packages['bottom_section']->first()->category->slug ?? '']) }}"
                    class="btn_1 rounded ">View all Tours</a>
            </p>
        </div>
        <!-- /container -->
        <div class="container container-custom margin_20_0">
            <div class="main_title_2">
                <h2 class=" homepage-title">What Our Clients Say</h2>
            </div>
            <div id="carousel" class="owl-carousel owl-theme owl-loaded owl-drag">
                <div class="owl-stage-outer">
                    <div class="owl-stage"
                        style="transition: all 0s ease 0s; width: 3850px; transform: translate3d(-1925px, 0px, 0px);">
                        <div class="owl-item cloned" style="width: 340px; margin-right: 10px;">
                            <div class="item">
                                <a href="#0">
                                    <div class="title testimonial-section">
                                        <p class="text-white">The trip was amazing and the assistance is <br>
                                            superb! They never dissappoint us and <br> the servicethey provided is
                                            <br> more than what we received.
                                        </p>
                                        <p class="text-white pull-right"> - Kelly</p>
                                    </div>
                                    <img src="{{ asset('images/homepage/rounded-cloud.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 340px; margin-right: 10px;">
                            <div class="item">
                                <a href="#0">
                                    <div class="title testimonial-section">
                                        <p class="text-white">The trip was amazing and the assistance is <br>
                                            superb! They never dissappoint us and <br> the servicethey provided is
                                            <br> more than what we received.
                                        </p>
                                        <p class="text-white pull-right"> - Kelly</p>
                                    </div>
                                    <img src="{{ asset('images/homepage/rounded-cloud-yellow.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="owl-item cloned" style="width: 340px; margin-right: 10px;">
                            <div class="item">
                                <a href="#0">
                                    <div class="title testimonial-section">
                                        <p class="text-white">The trip was amazing and the assistance is <br>
                                            superb! They never dissappoint us and <br> the servicethey provided is
                                            <br> more than what we received.
                                        </p>
                                        <p class="text-white pull-right"> - Kelly</p>
                                    </div>
                                    <img src="{{ asset('images/homepage/rounded-cloud-blue.png') }}" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /container -->
        <div class="bg_color_1">
            <div class="container margin_80_55">
                <div class="main_title_2">
                    <span>
                        <em></em>
                    </span>
                    <h3>News and Events</h3>
                    <p>Latest updates about tours and packages from our blogs</p>
                </div>
                <div class="row">
                    @forelse($blogs as $blog)
                        <div class="col-lg-6">
                            @php
                           
                                $url = '    '.$blog->slug;
                            @endphp
                            <a class="box_news" href="{{ $url }}">
                                <figure>
                                    <img src="{{ $blog->thumbnail_image ?? asset('images/default-img.jpg') }}" alt="" width="400px" height="267px">
                                    <figcaption>
                                        <strong>{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</strong>{{ \Carbon\Carbon::parse($blog->created_at)->formatLocalized('%b') }}
                                    </figcaption>
                                </figure>
                                <ul>
                                    <li>Author</li>
                                    <li>{{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}</li>
                                </ul>
                                <h4>{{ Str::limit($blog->title, 35) }}</h4>
                                <p>{!! Str::limit($blog->short_description, 105) !!}</p>
                            </a>
                        </div>
                    <!-- /box_news --> @empty <div class="d-flex justify-content-center">
                            <p>Nothing yet! </p>
                        </div>
                    @endforelse
                </div>
                <!-- /row -->
                <p class="btn_home_align">
                     @php
                           
                                $url = 'blogs/';
                            @endphp
                    <a href="{{ $url }}" class="btn_1 rounded ">View all</a>
                </p>
            </div>
            <!-- /container -->
        </div>
        </main>
        <!-- /main --> @include('frontend.layouts.footer')
        </div>
        <!-- page -->

        <!-- Child Age Popup -->
        <div class="modal fade" id="childage" tabindex="-1" role="dialog" aria-labelledby="childageLabel"
            aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">More details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="childageform">
                            <div class="sign-in-wrapper">
                                <div id="roomallocation"></div>
                                <div id="childageformdiv"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn_1 full-width" id="submitsearch">Search</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Child Age Popup -->
        <div id="toTop"></div>
        
        <!--<script src="https://apps.elfsight.com/p/platform.js" defer></script>-->
        <!--<div class="elfsight-app-9889109e-97d6-4be2-b262-f5063748ce6b"></div>-->
        
        <!-- Back to top button -->
        <script src="{{ asset('js/common_scripts.js') }}"></script>
        <script src="{{ mix('js/themescripts.js') }}"></script>
        <script src="{{ asset('js/input_qty.js') }}"></script>

        <script src="{{ asset('js/jarallax.min.js') }}"></script>
        <script src="{{ asset('js/jarallax-video.min.js') }}"></script>

        <script src="{{ asset('js/selectize.js') }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- DATEPICKER  -->
        <script>
            $(document).ready(function() {
                'use strict';
                $('input[name="dates"]').daterangepicker({
                    maxSpan: {
                        "days": 29
                    },
                    autoUpdateInput: false,
                    minDate: new Date(),
                    locale: {
                        cancelLabel: 'Clear'
                    }
                });
                $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY') + ' to ' + picker.endDate.format(
                        'DD-MM-YYYY'));
                });
                $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
                    $(this).val('');
                });
            });
        </script>
        <script src="{{ asset('js/typed.min.js') }}"></script>
        {{-- <script>
            var typed = new Typed('.element', {
                strings: ["{{ $settings->banner_text ?? '' }}"],
                startDelay: 10,
                loop: true,
                backDelay: 2000,
                typeSpeed: 50
            });
        </script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script type="text/javascript">
            var path = "{{ route('home_search') }}";
            $('#scrollable-dropdown-menu .typeahead').typeahead({
                limit: 25,
                hint: true,
                highlight: true,
                minLength: 3,
                source: function(query, process) {
                    return $.get(path, {
                        q: query
                    }, function(data) {

                        return process(data);
                    });
                }
            });
        </script>

        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5f6053294704467e89eefdc3/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>
        <!--End of Tawk.to Script-->
        <script>
            var spinner = $('#loader');

            // To get child age
            var children;
            var adult;
            var rooms;
            var totalchild = 0;
            var check = 0;
            var adultsInRoomCheck = 0;
            var childrenInRoomCheck = 0;
            var childrenAgecheck = 0;
            var multipleRoomCheck = 0;
            $('.btn_search').on('click', function(e) {
                e.preventDefault();
                children = document.getElementsByName('children')[0].value;
                adult = document.getElementsByName('adult')[0].value;
                rooms = document.getElementsByName('rooms')[0].value;
                date = document.getElementsByName('dates')[0].value;
                nationality = document.getElementsByName('nationality')[0].value;

                if (date == '') {
                    firealert('Date is required');
                    $('#loader').hide();
                    return;
                }

                if (nationality == '') {

                    firealert('Nationality is required');

                    $('#loader').hide();
                    return;
                }

                if (adult == 0) {

                    firealert('Minimum 1 Adult should be selected');
                    $('#loader').parent.hide();
                    return;
                }
                //  for children age
                if (children > 0) {
                    childrenAgecheck = 1;
                    $('#childageformdiv').empty();
                    for (let i = 0; i < children; i++) {
                        var j = parseInt(i) + 1;
                        var html = `
																																																																																	<div class="form-group">
																																																																																		<label>Child ` + j +
                            ` age </label>
																																																																																		<input type="text" class="form-control childage" name="childage[]" id="childagefromuser_` +
                            i + `" onkeyup="validateChildAge(this)" required>
																																																																																		</div>`;
                        $('#childageformdiv').append(html);
                    }
                    $('#childage').modal('show');
                }
                // else{
                //      $('#homesearch').submit();
                // }
                if (rooms > 1) {
                    multipleRoomCheck = 1;
                    adultsInRoomCheck = 1;
                    $('#roomallocation').empty();
                    for (let k = 0; k < rooms; k++) {
                        var l = parseInt(k) + 1;
                        var html2 = `
																																																																																		<div class="form-row">
																																																																																			<div class="col">
																																																																																				<p>Room ` + l + `</p>
																																																																																			</div>
																																																																																			<div class="col">
																																																																																				<input type="text" class="form-control adultcount" name="roomadult[]" onkeyup="validateAdultCount(this)" placeholder="Adults" required>
																																																																																				</div>`;
                        if (children > 0) {
                            childrenInRoomCheck = 1;
                            html2 += ` 
																																																																																				<div class="col">
																																																																																					<input type="text" class="form-control childcount" name="roomchild[]" onkeyup="validateChildCount(this)" placeholder="Children" >
																																																																																					</div>`
                        }
                        html2 += `
																																																																																				</div>`;
                        $('#roomallocation').append(html2);
                    }
                    $('#childage').modal('show');
                }
                if (multipleRoomCheck == 0 && childrenAgecheck == 0) {

                    spinner.show();
                    $('#homesearch').submit();
                }
            });
            $('#submitsearch').on('click', function(e) {
                $('#childageform input:required').each(function() {
                    if ($(this).val() === '') {
                        check = 1;
                        firealert('error please fill all fields!');
                        return false;
                    }
                });

                if (adultsInRoomCheck != 1 && childrenInRoomCheck != 1 && childrenAgecheck != 1) {

                    $('#childage').modal('hide');
                    $("#childageform").find(":input").prop("type", "hidden");
                    $("#childageform").find(":input").clone().appendTo("#homesearch");
                    spinner.show();
                    $('#homesearch').submit();
                }
            });

            function validateAdultCount(element) {
                var totaladults = 0;

                $('.adultcount').each(function(index, element) {
                    totaladults = totaladults + parseFloat($(element).val());
                });

                if (totaladults > adult) {
                    adultsInRoomCheck = 1;

                    firealert('Adults should be equal to ' + adult);
                    $(element).val('');
                    return;
                } else {
                    totaladults = 0;
                    adultsInRoomCheck = 0;
                    return true;
                }
            }

            function validateChildCount(element) {

                var totalchildren = 0;

                $('.childcount').each(function(index, element) {
                    totalchildren = totalchildren + parseFloat($(element).val());
                });

                if (totalchildren > children) {
                    $(element).val('');
                    childrenInRoomCheck = 0;

                    firealert('Children should be equal to ' + children);
                    return;
                } else {
                    totalchildren = 0;
                    childrenInRoomCheck = 0;
                    return true;
                }
            }

            function validateChildAge(element) {

                $('.childage').each(function() {
                    if ($(this).val() === '') {
                        childrenAgecheck = 1;
                        firealert('error please fill children age');
                        return false;
                    } else {
                        childrenAgecheck = 0;
                    }
                });

            }
        </script>

        <script>
            // var spinner = $('#loader');
            // $('.show-loading').click(function(){
            //    spinner.show();
            // });
        </script>

        @if (Session::has('success'))
            <script>
                firealert({{ session('success') }} , 'success');
            </script>
        @endif

        @if (Session::has('error'))
            <script>
                 Swal.fire({
                    title: '{{ session("error") }}',
                    icon: 'error',
                    showCloseButton: true
                });

            </script>            
        @endif

        {{-- @if($errors->has('error'))

            <script>
                firealert({{ $errors->first('error'), 'error' }});
            </script>   

            @endif --}}


        <script>
            function firealert(message , type = null ) {
                var icon = 'info' ; 
                if(type !=null ){
                    icon = type;
                }
                Swal.fire({
                    title: message,
                    icon: icon,
                    showCloseButton: true
                });

            }
        </script>

        <script>
            $("#nationality").selectize({
                placeholder: 'Nationality'
            });
        </script>

        
</body> @endsection
