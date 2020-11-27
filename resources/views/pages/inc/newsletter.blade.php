<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
	@if (session()->get('language') == 'bangla')
	<h3 class="section-title">নিউজলেটার</h3>
	@else
	<h3 class="section-title">Newsletters</h3>	
	@endif
	<div class="sidebar-widget-body outer-top-xs">
		@if(session()->get('language') == 'bangla')
		<p>সাইনআপ করুন নিউজলেটারে</p>
		@else 
		<p>Sign Up for Our Newsletter!</p>		
		@endif
        <form role="form" action="{{ url('newsletter/subscribe-store') }}" method="POST">
            @csrf 
			@if(session()->get('language') == 'bangla')
        	 <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">ইমেইল ঠিকানা</label>
			    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="নিউজলেটার সাবস্ক্রাইব করুন" data-validation="required">
              </div>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
			<button class="btn btn-primary">সাবস্ক্রাইব</button>
			@else
			  <div class="form-group">
			    <label class="sr-only" for="exampleInputEmail1">Email address</label>
			    <input type="email" name="email" data-validation="required" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
              </div>
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
			<button class="btn btn-primary">Subscribe</button>
			@endif
		</form>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->