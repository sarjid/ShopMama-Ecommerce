@extends('layouts.fontend_master')
@section('title') search result @endsection
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
				<li class='active'>Blog</li>
				<li class='active'>Search</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
	<div class="container">
		<div class="row">
			<div class="blog-page">
				<div class="col-md-9">
                @foreach ($blogs as $blog)
					<div class="blog-post outer-top-bd wow fadeInUp">
                        <a href="blog-details.html"><img class="img-responsive" src="{{ asset($blog->post_image) }}" alt=""></a>
                        @if(session()->get('language') == 'bangla')	
                        <h1><a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_bn) }}">{{ ucwords($blog->post_title_bn) }}</a></h1>
                        @else
                        <h1><a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_en) }}">{{ ucwords($blog->post_title_en) }}</a></h1>
                        @endif
                        <span class="author">{{ $blog->name }}</span>
                        @php
                            $comments = App\Blogcomment::where('post_id',$blog->id)->get();
                        @endphp
                        <span class="review">{{ count($comments) }} Comments</span>
                        <span class="date-time">{{ Carbon\Carbon::Parse($blog->created_at)->format('d F Y') }} ,{{  Carbon\Carbon::Parse($blog->created_at)->diffForHumans() }}</span>
                        @if(session()->get('language') == 'bangla')	
                        <p>{!! Str::words($blog->post_description_bn,150,'....') !!}</p>
                        <a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_bn) }}" class="lnk btn btn-primary">বিস্তারিত পড়ুন</a>
                        @else
                        <p>{!! Str::words($blog->post_description_en,150,'....') !!}</p>
                        <a href="{{ url('blog/post-deatils/'.$blog->id.'/'.$blog->post_slug_en) }}" class="lnk btn btn-primary">Read more</a>
                        @endif
                        
                    </div>
                @endforeach

<div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">
	<div class="text-right">
        {{ $blogs->links() }}
    </div><!-- /.text-right -->

</div><!-- /.filters-container -->				
</div>
  {{-- ========================= blog rightsidebar ====================  --}}
	@include('pages.inc.blog-sidebar')
	{{-- =========================End blog rightsidebar ====================  --}}
			</div>
		</div>
		<!-- ============================================== BRANDS CAROUSEL ============================================== -->
<div id="brands-carousel" class="logo-slider wow fadeInUp">

		<div class="logo-slider-inner">	
			<div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
				<div class="item m-t-15">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item m-t-10">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand3.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand6.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand2.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand4.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand1.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->

				<div class="item">
					<a href="#" class="image">
						<img data-echo="assets/images/brands/brand5.png" src="assets/images/blank.gif" alt="">
					</a>	
				</div><!--/.item-->
		    </div><!-- /.owl-carousel #logo-slider -->
		</div><!-- /.logo-slider-inner -->
	
</div><!-- /.logo-slider -->
<!-- ============================================== BRANDS CAROUSEL : END ============================================== -->	</div>
</div>

@endsection