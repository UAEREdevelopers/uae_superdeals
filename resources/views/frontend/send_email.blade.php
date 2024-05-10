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
				<h2 class="text-white">Send Mail</h2>
                </div>
            </div>
        </div>

        <div class="bg_color_1">
            <div class="container">
                <div class="row">
                <div class="col-md-12 text-center">
              <h2>Add name and send email</h2><br>
              <input type="text" name="name_input" id="name_input" class="form-control" placeholder="Put your name" ><br>
              <button class="btn btn-primary" onclick="sentMail()"> Send </button>




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

   <script>
   	
   	function sentMail(){
   		$.ajax({
            url: "{{ route('send_email_check') }}",
            type: "GET",
            data:{"name":$('#name_input').val()},
            dataType: "json",
            success: function (response) {
               alert(response);
            },
            error: function (xhr, status, error) {
                
            }
        });
   	}
   </script>

</body>
@endsection


