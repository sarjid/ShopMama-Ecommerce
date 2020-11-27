@php
    $blog_categories = App\Post_category::orderBy('category_name_en','ASC')->where('status',1)->get();
    $blog_posts = App\Blog::latest()->where('status',1)->limit('4')->get();
    $tags = App\Product::latest()->where('status',1)->get();
@endphp
<div class="col-md-3 sidebar">             
    <div class="sidebar-module-container">
        <div class="search-area outer-bottom-small">
            <form action="{{ route('blog-search') }}" method="POST">
                @csrf
                <div class="control-group"> 
                    <input name="blog_search" @if(session()->get('language') == 'bangla') placeholder="অনুসন্ধান করুন" @else placeholder="Type to search" @endif class="search-field" data-validation="required" >
                    <button type="submit" class="search-button"></button>   
                </div>
            </form>
        </div>		

<div class="home-banner outer-top-n outer-bottom-xs">
<img src="{{ asset('fontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
</div>
<!-- ==============================CATEGORY======================================== -->
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
<h3 class="section-title">@if(session()->get('language') == 'bangla') ক্যাটাগরিসমূহ @else Category @endif</h3>
<div class="sidebar-widget-body m-t-10">
    <div class="accordion">
        @foreach ($blog_categories as $category)
            <div class="accordion-group">
                <div class="accordion-heading">
                    <a href="#collapse{{ $category->id }}" data-toggle="collapse" class="accordion-toggle collapsed">
                        @if(session()->get('language') == 'bangla')
                        {{ $category->category_name_bn }}
                         @else
                        {{ $category->category_name_en }}
                        @endif
                    </a>
                </div><!-- /.accordion-heading -->
                <div class="accordion-body collapse" id="collapse{{ $category->id }}" style="height: 0px;">
                    @php
                        $subcategories = App\Post_subcategory::where('category_id',$category->id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get();
                    @endphp
                    <div class="accordion-inner">
                        <ul>
                            @foreach ($subcategories as $subcategory) 
                                @if(session()->get('language') == 'bangla')
                                <li><a href="{{ url('blog/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug_bn) }}">{{ $subcategory->subcategory_name_bn }}</a></li>
                                @else                              
                                <li><a href="{{ url('blog/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug_en) }}">{{ $subcategory->subcategory_name_en }}</a></li>
                                @endif
                             @endforeach                   
                        </ul>
                    </div><!-- /.accordion-inner -->
                </div><!-- /.accordion-body -->
            </div><!-- /.accordion-group -->
        @endforeach

    </div><!-- /.accordion -->
</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->
<!-- ============================== CATEGORY : END ======================================= -->	
<div class="sidebar-widget outer-bottom-xs wow fadeInUp">
<h3 class="section-title">   @if(session()->get('language') == 'bangla') নতুন পোষ্ট @else Recent Post @endif</h3>
<div class="tab-content" style="padding-left:0">
   <div class="tab-pane active m-t-20" id="popular">
    @foreach ($blog_posts as $post)
    <div class="blog-post inner-bottom-30" >
        <img class="img-responsive" src="{{ asset($post->post_image) }}" alt="">
        <h4>
            @if(session()->get('language') == 'bangla')
            <a href="{{ url('blog/post-deatils/'.$post->id.'/'.$post->post_slug_bn) }}">{{ $post->post_title_bn }}</a>
            @else 
            <a href="{{ url('blog/post-deatils/'.$post->id.'/'.$post->post_slug_en) }}">{{ ucwords($post->post_title_en) }}</a>
            @endif
        </h4>
        @php
        $comments = App\Blogcomment::where('post_id',$post->id)->get();
    @endphp
            <span class="review">{{ count($comments) }} Comments</span>
        <span class="date-time">{{ Carbon\Carbon::Parse($post->created_at)->format('d F Y') }}</span>
        <p> {!! Str::words($post->post_description_en,30,'..') !!}</p>
        
    </div>

    @endforeach
    
   </div>

</div>
</div>

<!-- ====================== PRODUCT TAGS ============================== -->
    @include('pages.inc.product-tag')
<!-- ================ PRODUCT TAGS : END ===========-->
             </div>
            </div>