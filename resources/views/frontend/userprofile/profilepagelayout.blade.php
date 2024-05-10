@extends('frontend.layouts.frontend')

@section('styles')
    <style>
        .typeahead.dropdown-menu {
            max-height: 230px;
            overflow-y: scroll;
        }

        p {
            text-align: justify;
        }

    </style>
@endsection


@section('content')

    <body class="datepicker_mobile_full">
        <!-- Remove this class to disable datepicker full on mobile -->

        <div id="page">
            <!-- /header -->
            @include('frontend.layouts.navbar')

            <!-- /header -->

            <main>
                <div class="hero_in cart_section last">
                    <div class="wrapper">
                        <div class="container">
                            <h2 class="text-white">Welcome back!</h2>
                        </div>
                    </div>
                </div>

                <div class="bg_color_1">
                    <div class="container" style="min-height: 50vh">
                        <div class="row py-4">
                            <nav class="col-md-2 d-none d-md-block sidebar">
                                <div class="sidebar-sticky">
                                    <ul class="nav flex-column">
                                        <li class="nav-item @if(Route::is('user_profile')) active  @endif profile-nav-item">
                                            <a href="{{route('user_profile')}}"> Profile
                                            </a>
                                        </li>

                                        <li class="nav-item @if(Route::is('user_bookings')) active  @endif profile-nav-item">
                                            <a href="{{route('user_bookings')}}"> Bookings
                                            </a>
                                        </li>

                                        <li class="nav-item @if(Route::is('wishlist')) active  @endif profile-nav-item">
                                            <a href="{{route('wishlist')}}"> Wishlist
                                            </a>
                                        </li>


                                    </ul>

                                </div>
                            </nav>

                            @yield('innercontent')

                        </div>


                    </div>
                    <!--/hero_in-->
            </main>

            <!-- /main -->
            @include('frontend.layouts.footer')
        </div>
        <!-- page -->
        <div id="toTop"></div>
        <!-- Back to top button -->
        <script src="{{ asset('js/common_scripts.js') }}"></script>
        <script src="{{ mix('js/themescripts.js') }}"></script>

    </body>
@endsection
