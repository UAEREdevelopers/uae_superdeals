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

            <div class="owl-carousel owl-theme" id="product-slider" style="padding-top:100px">
                <div class="item"><img src="{{ asset('images/iqibla/banner.png') }}" class="card-img-top"
                        alt=""></div>
                <div class="item"><img src="{{ asset('images/iqibla/1.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/2.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/3.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/4.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/5.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/6.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/7.png') }}" class="card-img-top" alt="">
                </div>
                <div class="item"><img src="{{ asset('images/iqibla/8.png') }}" class="card-img-top" alt="">
                </div>
            </div>

            <div class="bg_color_1">


                <div class="container margin_60_35">

                    <div class="isotope-wrapper">
                        {{-- <div class="row">
                            <div v-for="product in products" :key="product.name"
                                class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
                                <div class="box_grid">
                                    <figure>
                                        <img :src="product.image" class="img-fluid" alt="" width="800" height="533">
                                        <small>Buy 2 for AED 200</small>
                                    </figure>
                                    <div class="wrapper">
                                        <h3>@{{ product . name }}</h3>
                                        <p></p>
                                        <span class="price"><strong>AED @{{ product . price }}</strong></span>
                                    </div>

                                    <form method="POST" action="{{route('add_to_cart_product') }}">
                                        <input type="hidden" name="sku" :value="product.sku">
                                        <input type="hidden" name="product" :value="product.name">
                                        <input type="hidden" name="price" :value="product.price">
                                        @csrf 
                                    <ul>
                                        <li><input  type="number" class="form-control" step="1" min="0" max="10" name="qty"
                                                id="" placeholder="Qty" width="50px"></li>
                                        <li>
                                            <select name="size" id="" class="form-control">
                                                <option value="0" selected disabled>Size</option>
                                                <option value="18mm">18 mm</option>
                                                <option value="20mm">20 mm</option>
                                                <option value="22mm">22 mm</option>
                                            </select>
                                        </li>
                                        <li><button type="submit" class="btn btn-danger">ADD TO CART</button></li>
                                    </ul>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            
                             @foreach ($products as  $product)
                             
                            <div class="col-xl-4 col-lg-6 col-md-6 isotope-item popular">
                                <div class="box_grid">
                                    <figure>
                                        <img src="{{$product->image}}" class="img-fluid" alt="" width="800" height="533">
                                        <small>Buy 2 for AED 200</small>
                                    </figure>
                                    <div class="wrapper">
                                        <h3><a href="{{ route('show_product_details',$product->id) }}">{{$product->name }}</a></h3>
                                        <p></p>
                                        <span class="price"><strong>AED {{$product->price}}</strong></span>
                                    </div>

                                    <form method="POST" action="{{route('add_to_cart_product') }}">
                                        <input type="hidden" name="sku" value="{{$product->sku}}">
                                        <input type="hidden" name="product" value="{{$product->name}}">
                                        <input type="hidden" name="price" value="{{$product->price}}">
                                        @csrf 
                                    <ul>
                                        <li><input  type="number" class="form-control" step="1" min="0" max="10" name="qty"
                                                id="" value ="1" placeholder="Qty" width="50px"></li>
                                        <li>
                                            <select name="size" id="" class="form-control">
                                                <option value="0" selected disabled>Size</option>
                                                <option value="18mm">18 mm</option>
                                                <option value="20mm">20 mm</option>
                                                <option value="22mm">22 mm</option>
                                            </select>
                                        </li>
                                        <li><button type="submit" class="btn btn-danger">ADD TO CART</button></li>
                                    </ul>
                                    </form>
                                </div>
                            </div>
                             @endforeach
                        </div>
                        <!-- /row -->
                    </div>
                    <!-- /isotope-wrapper -->
                </div>

                <div class="container">
                    <div class="row pt-4" style="font-size: 16px">
                        <div class="col-md-12">
                            {!! $products->links() !!}
                        </div>
                    </div>
                </div>


            </div>
            <!-- /bg_color_1 -->

            <div class="container">

            </div>
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


    <script>
        new Vue({
            el: '#content',
            data: () => ({

                showModal: false,
                is_modal_visible: false,

                products: [{
                        name: 'Silver Ring',
                        sku:1,
                        price: 120,
                        image: '/images/iqibla/products/1.png'
                    },

                    {
                        name: 'Rose Gold Ring',
                        sku:2,
                        price: 120,
                        image: '/images/iqibla/products/2.png'
                    },

                    {
                        name: ' Gold Ring',
                        sku:3,
                        price: 120,
                        image: '/images/iqibla/products/3.png'
                    },

                    {
                        name: ' Space Grey Ring',
                        sku:3,
                        price: 120,
                        image: '/images/iqibla/products/4.jpg'
                    },

                    {
                        name: 'White Ring- Plastic',
                        sku:3,
                        price: 120,
                        image: '/images/iqibla/products/5.jpg'
                    },
                    {
                        name: 'Black Ring- Plastic',
                        sku:3,
                        price: 120,
                        image: '/images/iqibla/products/6.jpg'
                    },


                ]

            }),
            methods: {

                CalculatePriceForHotel(event) {

                    if (this.selectednight != 'undefined') {
                        daycheck = true;
                        this.price = this.selectedHotel.price[this.selectednight];
                    }

                    switch (this.selectednight) {
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
