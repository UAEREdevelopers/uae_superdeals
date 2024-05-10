 <header class="header menu_fixed">
            {{-- <div id="preloader">
                <div data-loader="circle-side"></div>
            </div> --}}
            <!-- /Page Preload -->
            <div id="logo">
                <div class="d-flex justify-content-center">
                    <div>
                        <a href="{{route('homepage')}}">
                    <img src="{{asset('img/logo.png')}}" width="75" height="75" alt="" class="logo_normal">
                    <img src="{{asset('img/logo.png')}}" width="75" height="75" alt="" class="logo_sticky">
                </a>
                    </div>
                    {{-- <div>
                        <a href="tel+971522405511" class="btn nav-call-btn">+971522405511</a></span>
                    </div> --}}
                </div>
                
                
            </div>
            <ul id="top_menu">
                
                
                        @guest
                        <li><a href="#" class="cart-menu-btn" style="top:-5px" title="Cart"><strong></strong></a></li>
                                @if (Route::has('login'))
                                <li><a href="#sign-in-dialog" id="sign-in"><i class="ti-lock login-section-icon"></i></a></li>
                                @endif
                        @else
                        <li><a href="#" class="cart-menu-btn" title="Cart"><strong></strong></a></li>
                            <li class="logout mt-6" >
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                                        <i class="ti-unlock login-section-icon"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                            
                             <li class="logout mt-6"><a href="{{route('user_profile')}}" class="dropdown-item" title="Your Profile"><i class="ti-settings login-section-profile" ></i></a></li>
                            {{-- <li><a href="{{route('wishlist')}}" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li> --}}
                        @endguest
            
                {{-- <li><i class="ti-user login-section-icon"></i></li>
                <li><a href="#sign-in-dialog" id="sign-in" class="login" title="Sign In">Sign In</a></li> --}}
                
            </ul>
            <!-- /top_menu -->
            <a href="#menu" class="btn_mobile">
                <div class="hamburger hamburger--spin" id="hamburger">
                    <div class="hamburger-box">
                        <div class="hamburger-inner"></div>
                    </div>
                </div>
            </a>

           <nav id="menu" class="main-menu">
               <ul>
                  
                   {{-- <li><span><a href="#">Home</a> </span> </li>
                   <li><span><a href="#">Flight</a> </span></li>
                   <li><span><a href="#">Package</a> </span></li> --}}

                    @foreach($categories as $category)
                    {{--  making pcr menu blink adding class blink_me --}}
                    <li @if($category->id == '13') class="blink_me" @endif><a href="{{($category->link)? env('APP_URL').$category->link:route('show_category', ['category' => $category->slug]) }}">{{$category->name}}</a>
                    <ul>
                               @foreach ($category->childrenCategories as $childCategory)
                                @include('frontend.layouts.child_category', ['child_category' => $childCategory])
                            @endforeach
                    </ul>
                    </li>
                    @endforeach
               </ul>
            </nav>         
        </header> 
 
         
 
 

                  
