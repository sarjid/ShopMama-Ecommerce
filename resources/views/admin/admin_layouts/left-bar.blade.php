<div class="sl-logo"><a href="{{ url('admin/home') }}"><img src="{{ asset('fontend/assets/images/logo.png') }}" alt="Shop Mama"> </a></div>
<div class="sl-sideleft">


  <div class="sl-sideleft-menu">
    <a href="{{ url('admin/home') }}" class="sl-menu-link @yield('dashboard') ">
      <div class="sl-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Dashboard</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
   
    <a href="{{route('brand.page') }}" class="sl-menu-link @yield('brands')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Brands</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    

    <a href="#" class="sl-menu-link @yield('categories')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Categories</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('category.page') }}" class="nav-link @yield('category')">Category</a></li> 
      <li class="nav-item"><a href="{{ route('subcategory.page') }}" class="nav-link @yield('sub_category')">Sub-Category</a></li> 
      <li class="nav-item"><a href="{{ route('sub-sub-category.page') }}" class="nav-link @yield('sub_sub_category')">Sub-Sub-Category</a></li>          
    </ul>

    <a href="{{route('slider.page') }}" class="sl-menu-link @yield('slider')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Main Slider</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <a href="#" class="sl-menu-link @yield('products')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Products</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('add-products') }}" class="nav-link @yield('add-products')">Add Products</a></li> 
      <li class="nav-item"><a href="{{ route('manage-products') }}" class="nav-link @yield('manage-products')">Manage Products</a></li> 
      <li class="nav-item"><a href="{{ route('review-products') }}" class="nav-link @yield('review-products')">Product Comment</a></li>             
    </ul>

    <a href="{{route('stock.page') }}" class="sl-menu-link @yield('stock')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Stock Management</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    
    <a href="{{route('coupon.page') }}" class="sl-menu-link @yield('coupon')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Coupon</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    
    <a href="#" class="sl-menu-link @yield('orders')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Orders</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('new-orders') }}" class="nav-link @yield('new-orders')">New Pending Order</a></li> 
      <li class="nav-item"><a href="{{ route('confirm-orders') }}" class="nav-link @yield('confirm-orders')">Confirm Orders</a></li>    
      <li class="nav-item"><a href="{{ route('processing-orders') }}" class="nav-link @yield('processing-orders')">Processing Orders</a></li>  
      <li class="nav-item"><a href="{{ route('picked-orders') }}" class="nav-link @yield('picked-orders')">Picked Orders</a></li>
      <li class="nav-item"><a href="{{ route('shipped-orders') }}" class="nav-link @yield('shipped-orders')">Shipped Orders</a></li>
      <li class="nav-item"><a href="{{ route('delivered-orders') }}" class="nav-link @yield('delivered-orders')">Delivered Orders</a></li>         
      <li class="nav-item"><a href="{{ route('cancel-orders') }}" class="nav-link @yield('cancel-orders')">Cancel Orders</a></li>
    </ul>

    <a href="#" class="sl-menu-link @yield('return-orders')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Return Orders</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('return-request-orders') }}" class="nav-link @yield('return-request-orders')">New Pending Request</a></li> 
      <li class="nav-item "><a href="{{ route('return-confirmed-orders') }}" class="nav-link @yield('return-confirmed-orders')">Return Confirmed</a></li> 
      <li class="nav-item "><a href="{{ route('return-cancel-orders') }}" class="nav-link @yield('return-cancel-orders')">Return Cancel</a></li> 
      
    </ul>

    <a href="#" class="sl-menu-link @yield('reports')">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Reports</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item "><a href="{{ route('todays-orders') }}" class="nav-link @yield('todays-orders')">Today's Order</a></li> 
        <li class="nav-item "><a href="{{ route('this-month-orders') }}" class="nav-link @yield('this-month-orders')">This Month Orders</a></li> 
        <li class="nav-item "><a href="{{ route('this-year-orders') }}" class="nav-link @yield('this-year-orders')">This Year Orders</a></li> 
        <li class="nav-item "><a href="{{ route('search-orders') }}" class="nav-link @yield('search-orders')">Search Orders</a></li> 
      </ul>

      <a href="#" class="sl-menu-link @yield('shipping_address')">
        <div class="sl-menu-item">
          <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
          <span class="menu-item-label">Shipping Address</span>
          <i class="menu-item-arrow fa fa-angle-down"></i>
        </div><!-- menu-item -->
      </a><!-- sl-menu-link -->
      <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item "><a href="{{ route('add-division') }}" class="nav-link @yield('division')">Add Divison</a></li> 
        <li class="nav-item"><a href="{{ route('add-district') }}" class="nav-link @yield('district')">Add District</a></li>          
        <li class="nav-item"><a href="{{ route('add-state') }}" class="nav-link @yield('state')">Add State</a></li>          
      </ul>

    <a href="#" class="sl-menu-link @yield('blogs')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Blogs</span>
        <i class="menu-item-arrow fa fa-angle-down"></i>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('add-category') }}" class="nav-link @yield('add-category')">Category</a></li> 
      <li class="nav-item "><a href="{{ route('add-sub-category') }}" class="nav-link @yield('add-sub-category')">Sub-Category</a></li> 
      <li class="nav-item "><a href="{{ route('add-post') }}" class="nav-link @yield('add-post')">Add Post</a></li> 
      <li class="nav-item"><a href="{{ route('manage-post') }}" class="nav-link @yield('manage-post')">Manage Posts</a></li>        
      <li class="nav-item"><a href="{{ route('blog-comment') }}" class="nav-link @yield('blog-comment')">Blog Comment</a></li>        
    </ul>

    <a href="{{route('subscirber.page') }}" class="sl-menu-link @yield('newsletter')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Subscriber List</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    <a href="{{route('testimonial.page') }}" class="sl-menu-link @yield('sub-admin')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Sub Admin</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    <a href="{{route('testimonial.page') }}" class="sl-menu-link @yield('testimonial')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Testimonial</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->

    <a href="#" class="sl-menu-link @yield('settings')">
      <div class="sl-menu-item">
        <i class="menu-item-icon ion-ios-photos-outline tx-20"></i>
        <span class="menu-item-label">Settings</span>
      </div><!-- menu-item -->
    </a><!-- sl-menu-link -->
    <ul class="sl-menu-sub nav flex-column">
      <li class="nav-item "><a href="{{ route('seo-setting') }}" class="nav-link @yield('seo-setting')">Seo Setting</a></li> 
      <li class="nav-item "><a href="{{ route('site-setting') }}" class="nav-link @yield('site-setting')">Site Setting</a></li> 
    
    </ul>
   
   
  </div><!-- sl-sideleft-menu -->

  <br>
</div><!-- sl-sideleft -->