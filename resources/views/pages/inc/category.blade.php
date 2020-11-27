@php
     $categories = App\Category::where('status',1)->orderBy('category_name_en','ASC')->get();
@endphp
<div class="side-menu animate-dropdown outer-bottom-xs">
	<div class="head"><i class="icon fa fa-align-justify fa-fw"></i>
		@if (session()->get('language') == 'bangla') ক্যাটাগরিসমূহ @else Categories @endif</div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
			@foreach ($categories as $cat)
            <li class="dropdown menu-item">
				@if (session()->get('language') == 'bangla')
				<a href="3" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $cat->category_icon }}" aria-hidden="true"></i>{{ $cat->category_name_bn }}</a>
				@else
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{ $cat->category_icon }}" aria-hidden="true"></i>{{ ucwords($cat->category_name_en )}}</a>
				@endif
                 <ul class="dropdown-menu mega-menu">
    		<li class="yamm-content">
			<div class="row">
				@php
					$subcategories = App\Subcategory::where('category_id',$cat->id)->where('status',1)->orderBy('subcategory_name_en','ASC')->get();
				@endphp
				@foreach ($subcategories as $subcat)
				<div class="col-sm-12 col-md-3">
					<ul class="links list-unstyled">  
						<li>
							@if (session()->get('language') == 'bangla')
							<a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_bn) }}"><strong>{{ $subcat->subcategory_name_bn }}</strong></a>
							@else
							<a href="{{ url('subcategory/products/'.$subcat->id.'/'.$subcat->subcategory_slug_en) }}"><strong>{{ $subcat->subcategory_name_en }}</strong></a>
							@endif
							</li>
						@php
						$subsubcategories = App\Subsubcategory::where('category_id',$cat->id)->where('subcategory_id',$subcat->id)->where('status',1)->orderBy('subsubcategory_name_en','ASC')->get();
						@endphp				
						@foreach ($subsubcategories as $subsubcat)
						<li>
							@if (session()->get('language') == 'bangla')
							<a href="{{ url('sub-subcategory/products/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_bn) }}">{{ $subsubcat->subsubcategory_name_bn }}</a>
							@else
							<a href="{{ url('sub-subcategory/products/'.$subsubcat->id.'/'.$subsubcat->subsubcategory_slug_en) }}">{{ $subsubcat->subsubcategory_name_en }}</a>
							@endif
						</li>  
						@endforeach
					</ul>
					
				</div><!-- /.col -->
				@endforeach
			</div><!-- /.row -->
		</li><!-- /.yamm-content -->                    
		</ul><!-- /.dropdown-menu -->
	</li><!-- /.menu-item -->	
	@endforeach

        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
