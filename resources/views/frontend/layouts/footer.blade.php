
  <div id="whatsapp">
             <a class="whatsapp-img" href="https://api.whatsapp.com/send?phone=971522405511&text=Hi%2C%20I%27m%20interested%20to%20know%20more%20about%20packages"> <img src="{{asset('images/whatsapp.png')}}" width="50%"/></a>
         </div>
<!-- Sign In Popup -->
        <div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3>Sign In</h3>
            </div>
            <form method="POST" action="{{ route('custom-login') }}"> @csrf <div class="sign-in-wrapper">
                @csrf
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-left">
                            <label class="container_check">Remember me <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="float-right mt-1">
                            <a id="forgot" href="javascript:void(0);">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Log In" class="btn_1 full-width">
                    </div>
            </form>
            <div class="text-center"> Don’t have an account? <a href="#register-dialog" id="register">Sign up</a>
            </div>
            <div id="forgot_pw">
                <form method="POST" action="{{ route('password.email') }}"> @csrf <div class="form-group">
                        <label>Please Enter Registered Email ID</label>
                        <input type="email" class="form-control" name="email" id="email_forgot">
                        <i class="icon_mail_alt"></i>
                    </div>
                    <p>You will receive an email containing a link allowing you to reset your password to a new preferred
                        one.</p>
                    <div class="text-center">
                        <input type="submit" value="{{ __('Send Password Reset Link') }}" class="btn_1">
                    </div>
                </form>
            </div>
        </div>
        <!--form -->
        </div>
        <!-- /Sign In Popup -->
        <!-- Register Pop up -->
        <div id="register-dialog" class="zoom-anim-dialog mfp-hide">
            <div class="small-dialog-header">
                <h3>Register</h3>
            </div>
            <form method="POST" action="{{ route('custom-registraion') }}"> @csrf <div class="sign-in-wrapper">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <i class="icon_profile"></i>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <i class="icon_mail_alt"></i>
                    </div>

                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" class="form-control" name="mobile" id="mobile">
                        <i class="icon_phone_alt"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="">
                        <i class="icon_lock_alt"></i>
                    </div>
                    <div class="clearfix add_bottom_15">
                        <div class="checkboxes float-left">
                            <label class="container_check">Remember me <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Register" class="btn_1 full-width">
                    </div>
                    <div class="text-center"> Already have an account? <a href="#sign-in-dialog"
                            id="sign-in-2">Login</a>
                    </div>
                    <div id="forgot_pw">
                        <div class="form-group">
                            <label>Please confirm login email below</label>
                            <input type="email" class="form-control" name="email_forgot" id="email_forgot">
                            <i class="icon_mail_alt"></i>
                        </div>
                        <p>You will receive an email containing a link allowing you to reset your password to a new
                            preferred one.</p>
                        <div class="text-center">
                            <input type="submit" value="Reset Password" class="btn_1">
                        </div>
                    </div>
                </div>
            </form>
            <!--form -->
        </div>
        <!-- /Register Popup -->
        
<footer>
            <div class="container margin_60_35">
                <div class="row">
                    <div class="col-lg-5 col-md-12 p-r-5">
                        <p><img src="{{asset('images/footer-logo.png')}}" width="100" height="auto" alt=""></p>
                        <p>We are the first in the market and the only one to take the risk, despite the evolving technology and the widespread replacement of human resources with bots, to return to the old-fashioned way that allows us to provide the best prices in the market.</p>
                        <div class="follow_us">
                            <ul>
                                <li>Follow us</li>
                                 <li><a href="https://www.instagram.com/uaesuperdeals/" target="_blank"><i class="ti-instagram"></i></a></li>
                                <li><a href="https://www.facebook.com/SuperdealsUAE15" target="_blank"><i class="ti-facebook"></i></a></li>
                                <li><a href="https://twitter.com/SuperDeals_AE" target="_blank"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="https://www.youtube.com/channel/UC2yi6PLI8Pg5Je5AZIqrJHw" target="_blank"><i class="ti-youtube"></i></a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 ml-lg-auto">
                        <h5>Useful links</h5>
                        <ul class="links">
                            <li><a href="{{route('about')}}">About</a></li>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="register.html">Register</a></li>
                            <li><a href="blog.html">News &amp; Events</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5>Contact with Us</h5>
                        <ul class="contacts">
                            <li><a href="tel:0588769830"><i class="ti-mobile"></i>+971 58 876 9830 , 045785805</a></li>
                            <li><a href="mailto:info@Panagea.com"><i class="ti-email"></i> info@superdeals.ae</a></li>
                        </ul>
                        <div id="newsletter">
                            <h6>Newsletter</h6>
                            <div id="message-newsletter"></div>
                            <form method="post" action="{{route('save_newsletter_subscriber')}}" name="newsletter_form" id="newsletter_form">
                                <input type="hidden" name="token" id="newsletter_token" value="{{ csrf_token()}}">
                                <div class="form-group">
                                    <input type="email" name="email" id="email_newsletter" class="form-control" placeholder="Your email">
                                    <input type="submit" class="" value="Submit" id="submit-newsletter">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--/row-->
                <hr>
                <div class="row">
                    <div class="col-lg-6">
                        <ul id="footer-selector">
                            <li>
                                <div class="styled-select" id="lang-selector">
                                    <select>
									<option value="English" selected>English</option>									
								</select>
                                </div>
                            </li>
                            <li>
                                <div class="styled-select" id="currency-selector">
                                    <select>
									<option value="AED" selected>AED</option>
								</select>
                                </div>
                            </li>
                            {{-- <li><img src="img/cards_all.svg" alt=""></li> --}}
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul id="additional_links">
                            <li><a href="{{route('terms')}}">Terms and conditions</a></li>
                            <li><a href="{{route('terms')}}">Refund & Cancellation</a></li>
                            <li><span>© {{ now()->year }} Superdeals</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!--/footer-->
  