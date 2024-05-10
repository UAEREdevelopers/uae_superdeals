@extends('frontend.layouts.frontend')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}">
<link rel="stylesheet" href="{{ asset('flaticons/font/flaticon.css') }}">
<link href="{{asset('frontend/css/blog.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div id="page">
	<!-- /header -->	
	@include('frontend.layouts.navbar')  
	<!-- /header -->
	
	<main>
			<section class="hero_in general" style="background: url('{{$blogOne->banner_image}}')"> 
				<div class="wrapper">
					<div class="container">
						<h1 class="fadeInUp"><span></span>{{$blogOne->title}}</h1>
					</div>
				</div>
			</section>
		<!--/hero_in-->

			<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-9">
						<div class="bloglist singlepost">
							<p><img alt="" class="img-fluid" src="{{$blogOne->thumbnail_image}}"></p>
							<h1>{{$blogOne->title}}</h1>
							<div class="postmeta">
								<ul>
									
									<li><a href="#"><i class="icon_clock_alt"></i> {{\Carbon\Carbon::parse($blogOne->created_at)->format('jS F Y')}} </a></li>
									<li><a href="#"><i class="icon_pencil-edit"></i></a></li>
									<li><a href="#"><i class="icon_comment_alt"></i> </a></li>
								</ul>
							</div>
							<!-- /post meta -->
							<div class="post-content">
								{!!$blogOne->description!!}
							</div>
							<!-- /post -->
						</div>
						<!-- /single-post -->

						<div id="comments">
							<h5>Comments</h5>
							<ul>
								<li>
									<div class="avatar">
										<a href="#"><img src="img/avatar1.jpg" alt="">
										</a>
									</div>
									<div class="comment_right clearfix">
										<div class="comment_info">
											By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#">Reply</a>
										</div>
										<p>
											Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
										</p>
									</div>
									<ul class="replied-to">
										<li>
											<div class="avatar">
												<a href="#"><img src="img/avatar2.jpg" alt="">
												</a>
											</div>
											<div class="comment_right clearfix">
												<div class="comment_info">
													By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#">Reply</a>
												</div>
												<p>
													Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
												</p>
												<p>
													Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut. Pellentesque ullamcorper venenatis elit idaipiscingi Duis tellus neque, tincidunt eget pulvinar sit amet, rutrum nec urna. Suspendisse pretium laoreet elit vel ultricies. Maecenas ullamcorper ultricies rhoncus. Aliquam erat volutpat.
												</p>
											</div>
											<ul class="replied-to">
												<li>
													<div class="avatar">
														<a href="#"><img src="img/avatar2.jpg" alt="">
														</a>
													</div>
													<div class="comment_right clearfix">
														<div class="comment_info">
															By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#">Reply</a>
														</div>
														<p>
															Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
														</p>
														<p>
															Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut. Pellentesque ullamcorper venenatis elit idaipiscingi Duis tellus neque, tincidunt eget pulvinar sit amet, rutrum nec urna. Suspendisse pretium laoreet elit vel ultricies. Maecenas ullamcorper ultricies rhoncus. Aliquam erat volutpat.
														</p>
													</div>
												</li>
											</ul>
										</li>
									</ul>
								</li>
								<li>
									<div class="avatar">
										<a href="#"><img src="img/avatar3.jpg" alt="">
										</a>
									</div>

									<div class="comment_right clearfix">
										<div class="comment_info">
											By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a href="#">Reply</a>
										</div>
										<p>
											Cursus tellus quis magna porta adipiscin
										</p>
									</div>
								</li>
							</ul>
						</div> 
						<hr>

						<h5>Leave a Comment</h5>
						<form>
							<div class="form-group">
								<input type="text" name="name" id="name2" class="form-control" placeholder="Name">
							</div>
							<div class="form-group">
								<input type="text" name="email" id="email2" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<input type="text" name="email" id="website3" class="form-control" placeholder="Website">
							</div>
							<div class="form-group">
								<textarea class="form-control" name="comments" id="comments2" rows="6" placeholder="Message Below"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" id="submit2" class="btn_1 rounded add_bottom_30"> Submit</button>
							</div>
						</form>

					</div>
					<!-- /col -->

					<aside class="col-lg-3">
						<div class="widget">
							<form>
								<div class="form-group">
									<input type="text" name="search" id="search" class="form-control" placeholder="Search...">
								</div>
								<button type="submit" id="submit" class="btn_1 rounded"> Search</button>
							</form>
						</div>
						<!-- /widget -->
						<div class="widget">
							<div class="widget-title">
								<h4>Recent Posts</h4>
							</div>
							<ul class="comments-list">

								

								
							</ul>
						</div>
						<!-- /widget -->
						<div class="widget">
							<div class="widget-title">
								<h4>Blog Categories</h4>
							</div>
							<ul class="cats">
								<li><a href="#">Admissions <span>(12)</span></a></li>
								<li><a href="#">News <span>(21)</span></a></li>
								<li><a href="#">Events <span>(44)</span></a></li>
								<li><a href="#">Focus in the lab <span>(31)</span></a></li>
							</ul>
						</div>
						<!-- /widget -->
						<div class="widget">
							<div class="widget-title">
								<h4>Popular Tags</h4>
							</div>
							<div class="tags">
								<a href="#">Information tecnology</a>
								<a href="#">Students</a>
								<a href="#">Community</a>
								<a href="#">Carreers</a>
								<a href="#">Literature</a>
								<a href="#">Seminars</a>
							</div>
						</div>
						<!-- /widget -->
					</aside>
					<!-- /aside -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
	</main>
	<!--/main-->


    <!--Footer-->
	 @include('frontend.layouts.footer')
    <!--Footer-->

	</div>
	<!-- page -->

 <div id="toTop"></div>
    <!-- Back to top button -->
    <script src="{{ asset('js/common_scripts.js') }}" ></script>
   <script src="{{ mix('js/themescripts.js') }}"></script>
@endsection