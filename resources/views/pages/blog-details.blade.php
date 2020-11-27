@extends('layouts.fontend_master')
@section('title') 
@if(session()->get('language') == 'bangla') {{ $blog->post_title_bn }} @else  {{ $blog->post_title_en }} @endif @endsection
@section('blog') active @endsection
@section('content')
@php
function bn_price($str)
	{
	$en = array(1,2,3,4,5,6,7,8,9,0);
	$bn = array('১','২','৩','৪','৫','৬','৭','৮','৯','০');
	$str = str_replace($en, $bn, $str);
	 return $str;
	}
@endphp
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Blog Details</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
					<div class="blog-post wow fadeInUp">
                        <img class="img-responsive" src="{{ asset($blog->post_image) }}" alt="">
                        @if(session()->get('language') == 'bangla')
                        <h1>{{ $blog->post_title_bn }}</h1>
                        @else
                        <h1>{{ $blog->post_title_en }}</h1>
                        @endif
                        <span class="author">{{ $blog->author->name }}</span>
                        <span class="review">{{ count($comments) }} Comments</span>
                        <span class="date-time">{{ Carbon\Carbon::Parse($blog->created_at)->format('d F Y') }}&nbsp;|&nbsp;{{ $blog->created_at->diffForHumans() }}</span>
                        @if(session()->get('language') == 'bangla')
                        <p>{!! $blog->post_description_bn !!}</p>
                        @else
                        <p>{!! $blog->post_description_en !!}</p>
                        @endif
                        <div class="social-media">
                            <span>share post:</span>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-linkedin"></i></a>
                            <a href="#" class="hidden-xs"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
              
	<div class="blog-review wow fadeInUp">
	<div class="row">
		<div class="col-md-12">
			<h3 class="title-review-comments">{{ count($comments) }} comments</h3>
		</div>
	@foreach ($comments as $comment)
		<div class="col-md-2 col-sm-2">
			<img src="{{ asset('fontend') }}/assets/images/testimonials/member3.png" alt="Responsive image" class="img-rounded img-responsive">
		</div>
		<div class="col-md-10 col-sm-10 blog-comments outer-bottom-xs">
			<div class="blog-comments inner-bottom-xs">
				<h4>{{ ucwords($comment->name) }}</h4>
				<span class="review-action pull-right">
					{{ $comment->created_at->diffForHumans() }}   
					
				</span>
				<p>{{ $comment->comment }}</p>
				<a href="#"> Reply</a>
			</div>
			{{-- <div class="blog-comments-responce outer-top-xs ">
				<div class="row">
					
					<div class="col-md-2 col-sm-2">
						<img src="{{ asset('fontend') }}/assets/images/testimonials/member2.png" alt="Responsive image" class="img-rounded img-responsive">
					</div>
					<div class="col-md-10 col-sm-10 outer-bottom-xs">
						<div class="blog-sub-comments inner-bottom-xs">
							<h4>Sarah Smith</h4>
							<span class="review-action pull-right">
								03 Day ago    
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam</p>
							<a href="#"> Reply</a>
							<a href="#"> Replied to </a>
						</div>
					</div>				
				
					
				</div>
			</div> --}}
		</div>
	@endforeach
		
		<div class="post-load-more col-md-12"><a class="btn btn-upper btn-primary" href="#">Load more</a></div>
	</div>
</div>
<div class="blog-write-comment outer-bottom-xs outer-top-xs">
	<div class="row">
		<div class="col-md-12">
			<h4>Leave A Comment</h4>
		</div>
	<form class="register-form" role="form" action="{{ url('blogs/comment/'.$blog->id) }}" method="POST">
		@csrf
		<div class="col-md-4">
				<div class="form-group">
			    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
				<input type="name" name="name" class="form-control unicase-form-control text-input" id="exampleInputName" placeholder="your name">
				@error('name')
				<strong class="text-danger">{{ $message }}</strong>
				@enderror
			  </div>
		</div>
		<div class="col-md-4">			
				<div class="form-group">
			    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
				<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1" placeholder="email address">
				@error('email')
				<strong class="text-danger">{{ $message }}</strong>
			@enderror
			  </div>
		</div>
		<div class="col-md-4">
				<div class="form-group">
			    <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
				<input type="text" name="title" class="form-control unicase-form-control text-input @error('title') is-invalid @enderror " id="exampleInputTitle" placeholder="title">
				@error('title')
					<strong class="text-danger">{{ $message }}</strong>
				@enderror
			  </div>			
		</div>
		<div class="col-md-12">		
				<div class="form-group">
			    <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
				<textarea class="form-control unicase-form-control" name="comment" placeholder="type your comment" id="exampleInputComments" ></textarea>
				@error('comment')
				<strong class="text-danger">{{ $message }}</strong>
				@enderror
			  </div>
		</div>
		<div class="col-md-12 outer-bottom-small m-t-20">
			<button type="submit" class="btn-upper btn btn-primary checkout-page-button">Submit Comment</button>
		</div>
	</form>	
  </div>
 </div>
</div>

	{{-- ========================= blog rightsidebar ====================  --}}
	@include('pages.inc.blog-sidebar')
	{{-- =========================End blog rightsidebar ====================  --}}
			</div>
		</div>
	</div>
</div>
@endsection