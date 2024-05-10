@extends('frontend.layouts.frontend')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('flaticons/font/flaticon.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <style>
        .hero_in.hotels_detail:before,
        .hero_in.hotels:before {
            background: none;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

    </style>

    <style>
        .hotels_detail{
               background: url('{{$package->banner_image}}');
               background-position:center;
           }
    </style>

    @if($package->mobile_banner_image !=null )
    <style>
       @media only screen and (max-width: 600px) {
           .hotels_detail{
               background: url('{{$package->mobile_banner_image}}');
           }
       }
    </style>
    @endif


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.css"
        integrity="sha512-YdYyWQf8AS4WSB0WWdc3FbQ3Ypdm0QCWD2k4hgfqbQbRCJBEgX0iAegkl2S1Evma5ImaVXLBeUkIlP6hQ1eYKQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        @if( $package->tracking_code)
    
    {!!$package->tracking_code!!}
        @endif

@endsection

@section('content')
    <div id="page">
        <!-- /header -->
        @include('frontend.layouts.navbar')
        <!-- /header -->

        <main>
            <section class="hero_in hotels_detail">
                <div class="wrapper">
                    <div class="container light-background">
                        @if( $package->category_id != 13 )
                        <h1 class="fadeInUp">{{ $package->title }}</h1>
                        <h4 class="fadeInUp">{{$package->city}} @if($package->country!= null ), @endif {{$package->country}}</h4>
                        @endif
                        {{-- <p style="padding-bottom: 5px"><img class="nighticon" src="{{asset('images/night-icon.png')}}" width="5%" alt=""> 5 Nights & 4 Days</p> --}}
                    </div>

                    @if( $package->category_id != 13 )
                    <span class="magnific-gallery">

                        <a href="{{ $package->banner_image }}" class="btn_photos btn_1" title=""
                            data-effect="mfp-zoom-in">View
                            Photos</a>

                        @if ($package->images)

                            @forelse($package->images as $image)

                                <a href="{{ $image->link }}" title="" data-effect="mfp-zoom-in"></a>

                            @empty

                            @endforelse

                        @endif
                    </span>

                    @endif
                </div>
            </section>
            <!--/hero_in-->

            <div class="bg_color_1">
                <nav class="secondary_nav sticky_horizontal">
                    <div class="container">
                        <ul class="clearfix">
                            {{-- <li><a href="#description" class="active">Description</a></li> --}}
                            {{-- <li><a href="#reviews">Reviews</a></li> --}}
                            {{-- <li><button class="btn_1 purchase" style="padding: 10px">Inquire Now</button></li> --}}
                        </ul>
                    </div>
                </nav>
                <div class="container margin_60_35">

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            @php
                                $itineraries = json_decode($package->itineraries);
                                $headings = json_decode($package->itinerary_heading);
                                
                                $days = null;
                                if ($itineraries != null) {
                                    $days = count($itineraries);
                                }
                                
                            @endphp
                            @if ($days != null)
                                <h4>Itinerary</h4>
                                <div class="panel-group" id="accordion">
                                    @for ($i = 0; $i < $days; $i++)

                                        @php
                                            $k = $i + 1;
                                            $day = 'Day ' . $k;
                                        @endphp
                                        <div class="panel panel-default ">
                                            <div class="panel-heading panel-default-black">
                                                <h4 class="panel-title text-white panel-title-black" data-toggle="collapse"
                                                    data-target="#collapse{{ $i }}">{{ $headings[$i] ?? $day }}
                                                </h4>
                                            </div>

                                            <div id="collapse{{ $i }}" class="panel-collapse collapse">
                                                <div class="panel-body" style="paddng-left:25px">
                                                    {!! $itineraries[$i] !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endif

                            <section id="description">
                                <h4></h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        {!! $package->description !!}
                                    </div>

                                </div>
                                <!-- /row -->

                            </section>

                            @if ($package->adult_price != null || $package->single_price != null || $package->child_price_under_11 != null || $package->child_price_under_5 != null || $package->infant_price != null)

                                <section id="pricing">
                                    <h5><b>Pricing</b> </h5>
                                    <div class="table-responsive-md">
                                        <table class="table table-bordered text-center">
                                            <thead>
                                                @if ($package->adult_price != null)
                                                    <th>Adult</th>
                                                @endif
                                                @if ($package->single_price != null)
                                                    <th>Single</th>
                                                @endif
                                                @if ($package->child_price_under_11 != null)

                                                    <th>Child (under 12 yrs)</th>
                                                @endif
                                                @if ($package->child_price_under_5 != null)
                                                    <th>Child (under 5 yrs) </th>
                                                @endif
                                                @if ($package->infant_price != null)
                                                    <th>Infant</th>
                                                @endif
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    @if ($package->adult_price != null)
                                                        <td>AED {{ number_format($package->adult_price,2 ) }}</td>
                                                    @endif
                                                    @if ($package->single_price != null)
                                                        <td>AED {{ number_format($package->single_price,2 )  }}</td>
                                                    @endif
                                                    @if ($package->child_price_under_11 != null)
                                                        <td>AED {{ number_format($package->child_price_under_11,2 )  }}</td>
                                                    @endif
                                                    @if ($package->child_price_under_5 != null)
                                                        <td>AED {{ number_format($package->child_price_under_5,2 )  }}</td>
                                                    @endif
                                                    @if ($package->infant_price != null)
                                                        <td>AED {{ number_format($package->infant_price,2 )  }}</td>
                                                    @endif
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>


                                </section>

                            @endif
                            <div class="row pb-4">
                                <div class="col-md-12 text-center">

                                    {{-- book now button for pcr test  --}}
                                     {{-- @if( $package->category_id == 25 ) --}}
                                    @if( $package->category_id == 13 )
                                      <button class="add_top_30 btn_1"
                                            onclick="booknowPCR()">
                                            Book Now</button>
                                    @endif

                                    @if ($package->adult_price != null || $package->single_price != null || $package->child_price_under_11 != null || $package->child_price_under_5 != null || $package->infant_price != null)
                                        <button class="add_top_30 btn_1"
                                            onclick="booknow('{{ $package->adult_price }}','{{ $package->single_price }}' ,'{{ $package->child_price_under_11 }}','{{ $package->child_price_under_5 }}','{{ $package->infant_price }}')">
                                            Book Now</button>
                                    @endif
                                    <button class="add_top_30 btn_1 purchase">Inquire Now</button>
                                </div>

                            </div>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->
                </div>
                <!-- /container -->
            </div>
            <!-- /bg_color_1 -->
        </main>
        <!--/main-->

        <!--Modal for user details -->

        {{--  Modal for PCR Testing  --}}
        {{-- @if($package->category_id == '25')  --}}
        @if($package->category_id == '13')        
            @include('frontend.package.pcrmodal');
       @endif

        {{--  for all other packages  --}}
         {{-- @if($package->category_id != '25') --}}
        @if($package->category_id != '13')

            <div class="modal fade" style="padding-top: 100px" id="userdetaisModal" tabindex="-1" role="dialog"
              aria-labelledby="userdetaisModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Submit Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('submit_package_interest') }}" id="interestform">
                                @csrf

                                <input type="hidden" name="price" value="{{ $package->package_price }}" id="">
                                <input type="hidden" name="is_inquiry" value="1">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-row">

                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Phone:</label>
                                        <input type="text" name="phone" id="phone" class="form-control" required>
                                    </div>

                                    <div class="col">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Nationality</label>
                                        <input type="text" name="nationality" class="form-control" required>
                                    </div>
                                    <div class="col-6">

                                        <label for="date" class="col-form-label">Date</label>
                                        <input type="text" name="date" id="date_inquiry" class="form-control" required>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Adults</label>
                                        <select name="adults" id="" class="form-control">
                                            <option value="0" selected>0</option>
                                            @for ($i = 0; $i < 10; $i++)
                                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Children (Age: 6 to 11)</label>
                                        <select name="children_count_under_11" class="form-control">
                                            <option value="0" selected>0</option>
                                            @for ($i = 0; $i < 10; $i++)
                                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Children (Age: 2 to 5) </label>
                                        <select name="children_count_under_5" class="form-control">
                                            <option value="0" selected>0</option>
                                            @for ($i = 0; $i < 10; $i++)
                                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="recipient-name" class="col-form-label">Infants</label>
                                        <select name="infants_count" class="form-control">
                                            <option value="0" selected>0</option>
                                            @for ($i = 0; $i < 10; $i++)
                                                <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" id="packageid" name="packageid" class="form-control"
                                    value="{{ $package->id }}">

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Special Requests:</label>
                                    <textarea class="form-control" id="message-text" name="specialrequest"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                        </form>
                    </div>
                </div>
           </div>

        <!--Modal for user details End -->

        <!-- Modal for Booking -->

        <div class="modal fade" style="padding-top: 100px" id="booknowModal" tabindex="-1" role="dialog"
            aria-labelledby="booknowModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Submit Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('submit_package_interest') }}" id="interestform">
                            @csrf

                            <input type="hidden" name="packageid" value="{{ $package->id }}">
                            <input type="hidden" name="price" value="" id="totalprice">

                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-row">

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Phone:</label>
                                    <input type="text" name="phone" id="phone2" class="form-control" required>
                                </div>

                                <div class="col">
                                    <label for="recipient-name" class="col-form-label">Email:</label>
                                    <input type="email" name="email" class="form-control" required>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Nationality</label>
                                    <input type="text" name="nationality" class="form-control" required>
                                </div>
                                <div class="col-6">

                                    <label for="date" class="col-form-label">Date</label>
                                    <input type="text" name="date" id="date_booking" class="form-control" required>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Adults</label>
                                    <select name="adults" id="" class="form-control"
                                        onchange="calclulateAdultprice('{{ $package->adult_price }}','{{ $package->single_price }}', this) ">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 10; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Children (Age: 6 to 11)</label>
                                    <select name="children_count_under_11"
                                        onchange="calculateChildprice('child_under_11','{{ $package->child_price_under_11 ?? 0 }}',this)"
                                        class="form-control">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 10; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Children (Age: 2 to 5) </label>
                                    <select name="children_count_under_5"
                                        onchange="calculateChildprice('child_under_5','{{ $package->child_price_under_5 ?? 0 }}',this)"
                                        class="form-control">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 10; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="recipient-name" class="col-form-label">Infants</label>
                                    <select name="infants_count"
                                        onchange="calculateChildprice('infant','{{ $package->infant_price ?? 0 }}',this)"
                                        class="form-control">
                                        <option value="0" selected>0</option>
                                        @for ($i = 0; $i < 10; $i++)
                                            <option value="{{ $i + 1 }}">{{ $i + 1 }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-row text-center pt-4">
                                <h4 class="btn btn-danger btn-lg btn-block">Total: AED <span id="showprice">0</span></h4>
                            </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal for Booking -->

        @endif

        


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

    <script>
        $(".purchase").on('click', function() {
            $('#userdetaisModal').modal('show');
            $('#toTop').hide();
        })


        function submitForm() {
            $("#interestform").submit();
        }
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

      <script>
        var phone2 = document.querySelector("#phone2");
        // here, the index maps to the error code returned from getValidationError - see readme
        var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

        var iti2 = window.intlTelInput(phone2, {
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
        phone2.addEventListener('keyup', function() {
            reset();
            if (phone2.value.trim()) {
                if (iti2.isValidNumber()) {
                    phone2.classList.remove("is-invalid");
                    phone2.classList.add("is-valid");
                    document.querySelector("#phone2").value = iti2.getNumber();
                } else {
                    phone2.classList.remove("is-valid");
                    phone2.classList.add("is-invalid");
                }
            }
        });

        // on keyup / change flag: reset
        phone2.addEventListener('change', reset);
        phone2.addEventListener('keyup', reset);
    </script>

    <script>
        function booknow(adultprice, singleprice, child_price_under_11, child_price_under_5, infant_price) {
            $('#booknowModal').modal('show');
            $('#toTop').hide();
        }


        function booknowPCR(){
              $('#booknowModal').modal('show');
            $('#toTop').hide();
        }
    </script>

    <script>
        var total = 0;
        var adultprice = 0;
        var child_under_11_price = 0;
        var child_under_5_price = 0;
        var infant_price = 0;

        function calclulateAdultprice(priceforadult, singleprice, select) {
            //  price is different for single and couple adults
            if (select.value != 1) {
                adultprice = parseInt(priceforadult) * select.value;
            } else {

                adultprice = singleprice;

                if( singleprice ==''){
                    adultprice = priceforadult;
                }
            }

            calculateTotal();
        }

        function calculateChildprice(childtype, price, select) {

           

            console.log(price);

            if (childtype == 'child_under_11') {

                child_under_11_price = parseInt(price) * select.value;

            }

            if (childtype == 'child_under_5') {
                child_under_5_price = parseInt(price) * select.value;

            }

            if (childtype == 'infant') {
                infant_price = parseInt(price) * select.value;

            }

            calculateTotal();

        }

        function calculateTotal() {

            total = parseInt(adultprice) + parseInt(child_under_11_price) + parseInt(child_under_5_price) + parseInt(
                infant_price);
            $('#totalprice').val(total);
            $('#showprice').html(total);
        }

        function calculatePCRTotal(select) {

            var price = 140;

            // if( select.value == 3 | select.value == 4 ) {
            //     price = 110;
            // }

            // if( select.value >= 5 ) {
            //     price = 100 ; 
            // }

            total = parseInt(price) * select. value; 

            $('#totalprice').val(total);
            $('#showprice').html(total);
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/1.0.10/datepicker.min.js"
        integrity="sha512-RCgrAvvoLpP7KVgTkTctrUdv7C6t7Un3p1iaoPr1++3pybCyCsCZZN7QEHMZTcJTmcJ7jzexTO+eFpHk4OCFAg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            var today = new Date();
            var tomorrow = new Date();
            var pcrdate = new Date();
            pcrdate.setDate(today.getDate() + 1);
            tomorrow.setDate(today.getDate() + 2);
            $('#date_inquiry').datepicker({
                fautoclose: true,
                startDate: tomorrow,
            });

            $('#date_booking').datepicker({
                fautoclose: true,
                startDate: tomorrow,
            });

            // for PCR 
            $('#date_inquiry_pcr').datepicker({
                fautoclose: true,
                startDate: pcrdate,
            });

            $('#date_booking_pcr').datepicker({
                fautoclose: true,
                startDate: pcrdate,
            });


        });
    </script>
@endsection
