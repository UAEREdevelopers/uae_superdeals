@extends('frontend.layouts.frontend')

@section('styles')
<style>
  
.typeahead.dropdown-menu {
  max-height: 230px;
  overflow-y: scroll;
}

p{
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
		
		<section class="hero_in general">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>About Superdeals</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->

		<div class="container margin_80_55">
			<div class="main_title_2">
				<span><em></em></span>
				<h2>Why Choose SuperDeals.ae</h2>
				<p style="text-align:center;">Explore Dubai like never before with SuperDeals.ae – Where Every Deal is an Adventure!</p>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-like2"></i>
						<h3>Exclusive Deals: </h3>
						<p>Our platform offers curated deals that provide exceptional value for money.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-id"></i>
						<h3>Convenience:  </h3>
						<p>Book your experiences with ease and confidence, thanks to our user-friendly website.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-culture"></i>
						<h3>Customer Satisfaction:</h3>
						<p>We prioritize your satisfaction, ensuring your journey with us is nothing short of spectacular.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-map-marker"></i>
						<h3>Wide Variety of Options:</h3>
						<p>We pride ourselves on offering a diverse range of options from adventurous getaways, relaxing retreats, or cultural experiences, our platform has a vast array of choices to suit every traveller. </p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-cash"></i>
						<h3>Transparent Pricing: </h3>
						<p>We believe in transparency, and that's why we are providing provides clear and honest pricing. No hidden fees or unexpected charges – what you see is what you get.</p>
					</a>
				</div>
				<div class="col-lg-4 col-md-6">
					<a class="box_feat" href="#0">
						<i class="pe-7s-plane"></i>
						<h3>Flexibility and Customization:</h3>
						<p>Recognizing that every traveller is unique, we offer flexibility and customization options for a truly personalized experience. Tailor your bookings to match your preferences</p>
					</a>
				</div>
			</div>
			<!--/row-->
		</div>
		<!-- /container -->

		<div class="bg_color_1">
			<div class="container margin_80_55">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Our Origins and Story</h2>
					<p style="text-align: center;font-size: 16px;">Explore Dubai like never before with SuperDeals.ae – Where Every Deal is an Adventure!</p>
				</div>
				<div class="row justify-content-between">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<p>At SuperDeals.ae, we're more than just a website; we're your ultimate companion in exploring the wonders of Dubai. Embark on a journey with us, where every click unveils a world of breath-taking adventures and exclusive experiences that will leave you in awe.</p>					
					 <h3>Who We Are</h3>
					 <p>SuperDeals.ae is a premier online platform dedicated to curating and offering the best deals for extraordinary experiences Dubai and globally. Our mission is to make every moment in this vibrant city memorable, offering a seamless booking experience for a diverse range of tours and attractions.</p>
					
					 <h3> Our Services</h3>
					  <h5>Flight Booking: </h5>
<p>Embark on a journey like never before with our seamless flight booking services. Whether you're a spontaneous adventurer or a meticulous planner, we've got you covered. Choose from a vast array of airlines, explore various routes, and find the best prices for your desired destinations. Our user-friendly platform ensures a hassle-free booking experience, putting you in control of your travel plans.</p>
						<h5>Hotel Booking: </h5>
					<h6>Where Comfort Meets Affordability:</h6>
					<p>At Super Deals, we understand the importance of a comfortable stay. Our hotel booking platform brings you a diverse selection of accommodations, ranging from boutique hotels to luxurious resorts. Filter your search based on your preferences - be it location, amenities, or budget - and discover the perfect home away from home.</p>
					<h5>Personalized Holiday Packages </h5>
					<p>As leading outbound tour operators in Dubai, our team is dedicated to curating unforgettable journeys tailored to your preferences. With a focus on Customized Tour Packages, we understand that each traveller is unique, and so are their travel aspirations. Our expertise lies in creating Personalized Holiday Packages that cater to your specific interests, ensuring every moment of your getaway is designed with you in mind. </p>
				<h6>Dubai Tour, Travel and Tourism deals:</h6>
				<h5>Tourist Visa Service for UAE</h6>
					<p>Navigate the paperwork hassle-free with our tourist visa service for UAE. We ensure a smooth entry into the dazzling emirate, allowing you to focus on making the most of your time in Dubai.
					</p>

					<h5>Burj Khalifa Ticket and Tour</h5>
<p>Ascend to new heights with our Burj Khalifa ticket and tour packages. Marvel at the panoramic views of the city skyline from the world's tallest building, creating memories that will last a lifetime.</p>
<h5>Wild Wadi Park Tour</h5>
<p>Cool off in style with our Wild Wadi Park tour. Experience exhilarating water rides and family-friendly attractions in this iconic water park nestled in the heart of Dubai.</p>
<h5>Dubai Desert Safari Tour</h5>
<p>Embark on an adventure like no other with our Dubai Desert Safari tour. Experience the thrill of dune bashing, camel rides, and a mesmerizing desert sunset, creating an unforgettable Arabian night.</p>
					</div>
					<div class="col-lg-6">

                    
<h5>Dhow Cruise Marina Tour</h5>
<p>Set sail on our Dhow Cruise Marina tour and experience the enchanting views of Dubai's illuminated skyline. Enjoy a delightful dinner on board as you glide along the serene waters of the Dubai Marina.</p>
<h5>Dubai Frame Tour</h5>
<p>Step into the future and past with our Dubai Frame tour. This architectural marvel offers a unique perspective, allowing you to witness the old and new Dubai in one breath-taking frame.</p>
<h5>Dubai Aquarium and Underwater Zoo</h5>
<p>Dive into a world of wonders with our Dubai Aquarium and Underwater Zoo tour. Witness marine life up close and personal as you explore the mesmerizing exhibits and tunnels.</p>
<h5>Miracle Garden and Global Village Tour</h5>
<p>Immerse yourself in the beauty of nature with our Miracle Garden and Global Village tour. Explore the vibrant floral displays at Miracle Garden before venturing into the multicultural haven of Global Village.</p>
<h5>Ski Dubai Snow Classic Tour</h5>
<p>Experience winter in the heart of the desert with our Ski Dubai Snow Classic tour. Enjoy skiing, snowboarding, and snow-filled fun in this indoor winter wonderland.</p>
<h5>Atlantis Aquaventure </h5>
<p>Dive into adventure with our Atlantis Aquaventure tour. Explore the thrilling water slides, encounter marine life, and relax on the pristine beaches of this iconic resort.</p>
<h5>Bollywood Park Tour</h5>
<p>Get ready for a dose of Bollywood magic with our Bollywood Park tour. Immerse yourself in the glitz and glamour of Indian cinema with vibrant attractions and live entertainment.</p>
<h5>IMG World of Adventure</h5>
<p>Unleash your inner adventurer with our IMG World of Adventure tour. Discover an array of thrilling rides and entertainment zones in one of the world's largest indoor theme parks.</p>
<h5>La Perle Dragone Tour </h5>
<p>Experience the magic of live entertainment with our La Perle Dragone tour. Be captivated by a stunning combination of acrobatics, aquatic feats, and state-of-the-art technology in this awe-inspiring show.</p>
<h5>Glow Garden Tour</h5>
<p>Step into a world of enchantment with our Glow Garden tour. Witness the glow of millions of lights illuminating whimsical displays and sculptures in this dazzling garden.</p>
<h5>VR Park Tour</h5>
<p>Explore the realms of virtual reality with our VR Park tour. Immerse yourself in a world where the boundaries between reality and imagination blur, offering an unparalleled gaming and entertainment experience.</p>

				</div>
				</div>
				<!--/row-->
			</div>
			<!--/container-->
		</div>
		<!--/bg_color_1-->

		
	</main>
	<!--/main-->
	
	   <!-- /main -->
       @include('frontend.layouts.footer')
    </div>
    <!-- page -->
    <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>  

</body>
@endsection


    {{-- <script src="js/main.js"></script>
	<script src="assets/validate.js"></script> --}}