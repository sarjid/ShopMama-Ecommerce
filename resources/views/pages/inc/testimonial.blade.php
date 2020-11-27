@php
    $testimonials = App\Testimonial::latest()->get();
@endphp
<div class="sidebar-widget  wow fadeInUp outer-top-vs ">
	<div id="advertisement" class="advertisement">
    @foreach ($testimonials as $row)
        <div class="item">
        <div class="avatar"><img src="{{ asset($row->image) }}" alt="Image"></div>
		<div class="testimonials"><em>"</em>{{ $row->review }}<em>"</em></div>
		<div class="clients_author">{{ $row->client_name }}
		</div><!-- /.container-fluid -->
        </div><!-- /.item -->
    @endforeach 

    </div><!-- /.owl-carousel -->
</div>