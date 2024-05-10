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
		<div class="hero_in cart_section last">
			<div class="wrapper">
				<div class="container">
				<h2 class="text-white">Terms and conditions</h2>
                </div>
            </div>
        </div>

        <div class="bg_color_1">
            <div class="container">
                <div class="row">
                <div class="col-md-12 text-center">
              <h2>Terms Of Sale</h2>
					<h5>INTRODUCTION</h5>
				
						<p>
							* These Terms of Sale set out the terms and conditions on which products are supplied to you as a buyer on www.superdeals.ae. The owner and operator of the Site is Superdeals LLC, a limited liability company registered in the United Arab Emirates (“UAE”) ”), with its office located at The Bayswater Tower, 1002 in Business Bay, Dubai in the UAE (“we”, “our” or “us”).
						</p>
						<p>
						* Please read these terms carefully before you submit your order via the Site. By placing an order on the Site, you are agreeing to be bound by these Terms of Sale with immediate effect.
					</p>
					<h5>ORDER ACCEPTANCE</h5>
					
					<p><b>Supplier.</b>  Each product in your order is sold either by us or by the local or international seller that is specified on the Site.</p>
					<p><b></b> Order Acceptance. Our acceptance of your order will take place when we notify you of our acceptance in writing (e.g. by email or mobile messaging). If we are unable to accept your order, we will inform you of this in writing or through a call and will not charge you for the product.</p>
					<p><b></b> Payment. By placing an order, you authorize us or our third-party payment processer to process your credit/debit card details for the amount of your order. We accept payment by credit/debit card. </p>
					<p> In order toauthorize credit/debit card payments, we may be required to create an account for you with our third-party payment processors, including accepting their standard terms and conditions and submitting your details to them on your behalf. You hereby authorize us to do so and we shall not be liable to you for any damage or loss you may incur as a result.</p>
					<p>  We may remove or add cards or other payment methods that we accept at any time without prior notice to you.</p>
					<h5>CANCELLATION</h5>
					<p><b>Cancelling Order</b> . You may cancel your order immediately prior to shipping for any reason.</p>
					<p><b>Our Cancellation.</b>    We may cancel your order(s) if:</p>
					<p>   you do not make any payment to us when it is due</p>
					<p>you do not, within a reasonable time of us asking for it, provide us with information that is necessary for us to provide the products; or</p>
					<p>you do not, within a reasonable time, allow us to deliver the products to you or collect them from us; or</p>
					<p><b>Bulk/Multiple Purchasing</b> . We reserve the right to reject any orders, at our sole discretion, where we detect bulk purchasing or multiple units of similar products being purchased.</p>
						<h5> RETURNS</h5>
						<p>You can return item if it meets any of the following</p>
						<p>You have received a wrong product;You have received a product that is not as described on the Site; or You have received a damaged product.</p>
						<p>Non-returnable Products. You do not have a right to return, replace or exchange products in respect of:</p>
						<p>  products that are classified as hazardous materials or use flammable liquids or gases;</p>
						<p>products that have been used or damaged by you or are not in the same condition as you received them;</p>
						<p>any consumable product which has been used or installed;</p>
						<p>products with tampered or missing serial numbers</p>
						<p><b> Contacting Us (arrange a Return).</b> You may contact us through email, social media or live chat on the Site, or by calling our call centre +971522405511</p>
					<h5>REFUND</h5>
					<p>For delivered products, we will refund to you the product amount (excluding the amount paid for the original shipping fees) in full plus the cost of return:</p>
					<p>if the products are faulty or not as described on our Site; or</p>
					<p>if you reason for return is due to an error on our side, such as an error in pricing or description, a delay in delivery etc.</p>
					<p>In all other circumstances, we will refund the product amount (excluding the amount paid for the original shipping fees) and you may pay the costs of return shipping.</p>

				</div>
            </div>
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
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>  

</body>
@endsection
