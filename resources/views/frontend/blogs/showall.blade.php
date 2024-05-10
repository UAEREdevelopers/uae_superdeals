@extends('frontend.layouts.frontend')

@section('styles')

<link href="{{asset('frontend/css/blog.css')}}" rel="stylesheet">
@endsection

@section('content')
	<div id="page">
	<!-- /header -->	
	@include('frontend.layouts.navbar')  
	<!-- /header -->
	
	<main>
		<section class="hero_in general" style="background: url('{{asset('/images/Sample Banner-10.png')}}')">
			<div class="wrapper">
				<div class="container">
					<h1 class="fadeInUp"><span></span>SuperDeals Blogs</h1>
				</div>
			</div>
		</section>
		<!--/hero_in-->

		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-9">

					@forelse ($blogs as $blog)
					@php
                           
                                $url = $blog->slug;
                            @endphp
						<article class="blog wow fadeIn">
						<div class="row no-gutters">
							<div class="col-lg-7">
								<figure>
									<a href="{{$url}}"><img src="{{$blog->thumbnail_image}}" alt="{{ Str::limit($blog->title, 35) }}">
										<div class="preview"><span>Read more</span></div>
									</a>
								</figure>
							</div>
							<div class="col-lg-5">
								<div class="post_info">
									<small> {{\Carbon\Carbon::parse($blog->created_at)->format('jS F Y')}}</small>
									<h3><a href="{{$url}}">{{ Str::limit($blog->title, 35) }}</a></h3>
									<p>{!! Str::limit($blog->short_description, 150) !!}</p>
									<ul>
										<li>
											<div class="thumb"><img src="" alt=""></div>
										</li>
										<li>
											<a href="{{$url}}">
										<div class="preview1"><span>Read more</span></div>
</a>	
</li>
										<li><i class="icon_comment_alt"></i></li>
									</ul>
								</div>
							</div>
						</div>
					</article>
					<!-- /article -->
					@empty
						<p>No Blogs yet! </p>
					@endforelse

					

					 <div class="d-flex justify-content-center">
							{{ $blogs->withQueryString()->links() }}
					 </div>
					
					<!-- /pagination -->
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

							@forelse ($blogs as $blog)
							@php
                           
                                $url = $blog->slug;
                            @endphp
							<li>
								<div class="alignleft">
									<a href="{{$url}}"><img src="{{$blog->thumbnail_image}}" alt="{{ Str::limit($blog->title, 35) }}"></a>
								</div>
								<small>{{\Carbon\Carbon::parse($blog->created_at)->format('jS F Y')}}</small>
								<h3><a href="{{$url}}" title="">{{ Str::limit($blog->title, 35) }}</a></h3>
							</li>

							@empty

							<p>No Blogs yet!</p>

							@endforelse

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