@extends('frontend.layouts.frontend')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('flaticons/font/flaticon.css') }}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div id="page">
        <!-- /header -->
        @include('frontend.layouts.navbar')
        <!-- /header -->

        <main id="content">
            <section class="hero_in hotels_detail expo2020-img" style="background: url('/images/expo2020/expo2020-1.jpg')">
                <div class="wrapper remove-overlay">
                    <div class="container">
                        <h1 class="fadeInUp homepage-title" style="font-size: 5rem; font-weight:900">Expo 2020 Deals</h1>
                        <h2 class="fadeInUp text-white text-bold">Starting from AED 1500 </h2>
                    </div>
                    <span class="magnific-gallery">

                        <a href="" class="btn_photos" title="" data-effect="mfp-zoom-in">View
                            photos</a>
                    </span>
                </div>
            </section>
            <!--/hero_in-->

            <div class="bg_color_1">
                <nav class="secondary_nav sticky_horizontal" id="secondary_nav">
                    <div class="container">
                        <ul class="clearfix">
                            {{-- <li><a href="#description" class="active">Description</a></li> --}}
                            {{-- <li><a href="#reviews">Reviews</a></li> --}}
                            {{-- <li> <button class="btn_1 purchase">Book Now</button></li> --}}
                        </ul>
                    </div>
                </nav>
                <div class="container margin_60_35">

                    <div class="row text-center">
                        <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="text-center">Book Your Expo2020 Dubai visit in 3 simple steps</h3>
                                    </div>
                                </div>
                        </div>
                        <!-- /col -->
                    </div>
                     <hr>
                    <!-- /row -->
                    <form action="{{ route('expodeals-submit') }}" method="post">
                        @csrf 
                    
                        <input type="hidden" name="price" v-model="price">
                        <input type="hidden" name="days_selected" v-model="nights">
                        <input type="hidden" name="hotel_selected" v-model="selectedHotel.hotel">
                    <div class="row" style="transform: none;">
                        <div class="col-lg-12">
                            <div class="box_cart">

                                <div class="form_title">
                                    <h3><strong>1</strong>Select Nights</h3>

                                </div>
                                <div class="step">

                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio"  id="nights1" value="0"  v-model="selectednight" @change="CalculatePriceForHotel">
                                                <label for="nights1">
                                                    <img src="{{ asset('images/expo2020/days/4.png') }}">
                                                </label>
                                            </a>
                                        </div>
                                        <div class="">
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio"  id="nights2" value="1"  v-model="selectednight" @change="CalculatePriceForHotel">
                                                <label for="nights2">
                                                    <img src="{{ asset('images/expo2020/days/5.png') }}">
                                                </label>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio" id="nights3" value="2"  v-model="selectednight" @change="CalculatePriceForHotel">
                                                <label for="nights3">
                                                    <img src="{{ asset('images/expo2020/days/6.png') }}">
                                            </a>
                                        </div>


                                    </div>


                                </div>
                                <hr>
                                <!--End step -->

                                <div class="form_title">
                                    <h3><strong>2</strong>Select Hotel</h3>
                                    <p>

                                    </p>
                                </div>
                                <div class="step">
                                    <!--End row -->

                                    <div class="d-flex justify-content-around">
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio"  id="hotel1" :value="{price:[10,20,30], hotel: 'hotel1'}" v-model="selectedHotel" @change="CalculatePriceForHotel">
                                                <label for="hotel1">
                                                    <img src="{{ asset('images/expo2020/days/Fairmont-1.png') }}">
                                                    
                                                </label>
                                            </a>
                                            <div class="text-center text-dark">
                                                    <span >Hotel 1</span>
                                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
                                                </div>  
                                        </div>
                                        <div class="">
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio" id="hotel2" :value="{price:[100,200,300], hotel: 'hotel2'}"  v-model="selectedHotel" @change="CalculatePriceForHotel">
                                                <label for="hotel2">
                                                    <img src="{{ asset('images/expo2020/days/Fairmont-1.png') }}">
                                                     
                                                </label>
                                            </a>
                                            <div  class="text-center text-dark">
                                                       <span>Hotel 2</span>
                                                        <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
                                                </div>
                                        </div>
                                        <div>
                                            <a href="#" class="col-sm-4 icon">
                                                <input type="radio"  id="hotel3" :value="{price:[1000,2000,3000], hotel: 'hotel3'}" v-model="selectedHotel" @change="CalculatePriceForHotel">
                                                <label for="hotel3">
                                                    <img src="{{ asset('images/expo2020/days/Fairmont-1.png') }}">
                                                </label>                                              
                                            </a>
                                              <div class="text-center text-dark">
                                                    <span >Hotel 3</span>
                                                    <div class="cat_star"><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i><i class="icon_star"></i></div>
                                                </div>
                                                
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <p> You have selected <span>@{{ this.nights }} <span
                                    v-if="this.daycheck">Nights</span> </span> at <span> @{{ this.selectedHotel.hotel }} </span></p>
                            
                            <h6 class="text-danger">Final price: @{{ price }} AED </h6>
                                </div>
                                <hr>
                                <!--End step -->

                                <div class="form_title">
                                    <h3><strong>3</strong>Your Details</h3>
                                    <p>

                                    </p>
                                </div>
                                <div class="step">
                                    
                                        <div class="form-row">
                                            <div class="col-md-4">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input type="text" name="name" class="form-control" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="recipient-name" class="col-form-label">Phone:</label>
                                                <input type="text" name="phone" id="phone" class="form-control" required>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="recipient-name" class="col-form-label">Email:</label>
                                                <input type="email" name="email" class="form-control" required>
                                            </div>

                                        </div>
                                    
                                    <!--End row -->
                                </div>
                                <hr>
                                <!--End step -->
                                <div id="policy">
                                    <h5>Cancellation policy</h5>
                                    <p class="nomargin">Cancellations must be done atleast 1 week before selected
                                        dates. <a href="{{ route('terms') }}">Terms & conditions</a> apply</p>
                                </div>
                            </div>
                        </div>
                        <!-- /col -->
                    </div>

                    <div class="row pb-4">
                        <div class="col-md-12 text-center">
                            <button class="add_top_30 btn_1" type="submit">Book Now</button>
                        </div>

                    </div>

                       </form>



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
    <script src="{{ asset('js/input_qty.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>


    <!-- DATEPICKER  -->
    <script>
        $(function() {
            $('.dates').daterangepicker({
                autoUpdateInput: false,
                parentEl: '.scroll-fix',
                minDate: new Date(),
                opens: 'left',
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            $('.dates').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM-DD-YY') + ' > ' + picker.endDate.format(
                    'MM-DD-YY'));
            });
            $('.dates').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
        });
    </script>





    <script>
        $(".purchase").on('click', function() {



            $('#userdetaisModal').modal('show');
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
        new Vue({
            el: '#content',
            data: () => ({

                showModal: false,

                is_modal_visible: false,

                price: 0,
                nights:'',

                daycheck: false,
                selectednight:'',

                selectedDay: {
                    price: 0,
                    dayselected: ''
                },

                selectedHotel: {
                    price: 0,
                    hotelselected: ''
                },

                days: [{
                        day: 6,
                        id: 0
                    },
                    {
                        day: 7,
                        id: 1
                    },
                    {
                        day: 8,
                        id: 2
                    },
                ],

                hotels: [

                    {
                        name: 'hotel1',
                        price: [100, 200, 300]
                    },
                    {
                        name: 'hotel2',
                        price: [1000, 2000, 3000]
                    },
                    {
                        name: 'hotel3',
                        price: [10000, 20000, 30000]
                    },

                ]

            }),
            methods: {

                CalculatePriceForHotel(event) {

                    if( this.selectednight !='undefined')
                    {
                        daycheck = true;
                        this.price = this.selectedHotel.price[this.selectednight];
                    }

                    switch (this.selectednight)
                    {
                        case "0":
                        this.nights = '6 Nights';
                        break;

                        case "1":
                        this.nights = '7 Nights';
                        break;

                        case "2":
                        this.nights = '8 Nights';
                        break;

                        default:

                        this.nights = 0;
                        break;  
                    } 
           
                   
                }

            }
        });
    </script>


@endsection
