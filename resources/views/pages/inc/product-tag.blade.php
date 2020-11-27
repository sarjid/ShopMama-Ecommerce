@php
	//  $tags = App\Product::latest()->where('status',1)->get();
     $en_tags = App\Product::groupBy('product_tags_en')->select('product_tags_en')->get();
     $bn_tags = App\Product::groupBy('product_tags_bn')->select('product_tags_bn')->get();
	
@endphp
<div class="sidebar-widget product-tag wow fadeInUp">
	<h3 class="section-title"> @if(session()->get('language') == 'bangla')পণ্যের ট্যাগসমূহ @else Product tags @endif</h3>
	<div class="sidebar-widget-body outer-top-xs">
		<div class="tag-list">	
			@if (session()->get('language') == 'bangla')
				@foreach ($bn_tags as $tag)
				<a class="item active" title="{{ $tag->product_tags_bn }}" href="{{ url('product/tag/'.$tag->product_tags_bn) }}">{{ str_replace(',',' ',$tag->product_tags_bn) }}</a>
				@endforeach		
			@else
				@foreach ($en_tags as $tag)
				<a class="item active" title="$tag->product_tags_en" href="{{ url('product/tag/'.$tag->product_tags_en) }}">	{{ str_replace(',',' ',$tag->product_tags_en) }}</a>
				@endforeach		
			@endif			
		</div><!-- /.tag-list -->
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->