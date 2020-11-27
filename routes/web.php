<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FontendController@index');

Auth::routes();

Route::get('admin/home', 'AdminController@index');
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@Login');
Route::get('admin/logout','AdminController@logout')->name('admin.logout');
// ================================= ** Brands ** ==================================== 
Route::get('admin/brands-all','Admin\BrandController@BrandPage')->name('brand.page');
Route::post('admin/brands-add','Admin\BrandController@StoreBrand')->name('store.brand');
Route::get('admin/brands-edit/{brand_id}','Admin\BrandController@EditBrand');
Route::post('admin/brands-update','Admin\BrandController@UpdateBrand')->name('update.brand');
Route::get('admin/brands-delete/{brand_id}','Admin\BrandController@DeleteBrand');
Route::get('admin/brands-inactive/{brand_id}','Admin\BrandController@Inactive');
Route::get('admin/brands-active/{brand_id}','Admin\BrandController@Active');
// ====================== main slider banner part ====================== 
Route::get('admin/slider-all','Admin\SliderController@sliderPage')->name('slider.page');
Route::post('admin/slider-store','Admin\SliderController@storeSlider')->name('store.slider');
Route::get('admin/slider-edit/{slider_id}','Admin\SliderController@sliderEdit');
Route::post('admin/slider-update','Admin\SliderController@sliderUpdate')->name('update.slider');
Route::get('admin/slider-delete/{slider_id}','Admin\SliderController@sliderDelete');
Route::get('admin/slider-inactive/{slider_id}','Admin\SliderController@Inactive');
Route::get('admin/slider-active/{slider_id}','Admin\SliderController@Active');
// ===================================== Category ==================================== 
Route::get('admin/categories','Admin\CategoryController@Catindex')->name('category.page');
Route::post('admin/categories-add','Admin\CategoryController@StoreCategory')->name('store.category');
Route::get('admin/categories-edit/{cat_id}','Admin\CategoryController@EditCat');
Route::post('admin/categories-update/{cat_id}','Admin\CategoryController@UpdateCat');
Route::get('admin/categories-delete/{cat_id}','Admin\CategoryController@DeleteCat');
Route::get('admin/categories-inactive/{cat_id}','Admin\CategoryController@Inactive');
Route::get('admin/categories-active/{cat_id}','Admin\CategoryController@Active');
// ======================================= Sub Category =================================
Route::get('admin/sub-categories','Admin\CategoryController@SubCatindex')->name('subcategory.page');
Route::post('admin/sub-categories-add','Admin\CategoryController@StoreSubCategory')->name('store.subcategory');
Route::get('admin/sub-categories-edit/{subcat_id}','Admin\CategoryController@EditSubCat');
Route::post('admin/sub-categories-update/{subcat_id}','Admin\CategoryController@UpdateSubCat');
Route::get('admin/sub-categories-delete/{subcat_id}','Admin\CategoryController@DeleteSubCat');
Route::get('admin/sub-categories-inactive/{subcat_id}','Admin\CategoryController@InactiveSubcat');
Route::get('admin/sub-categories-active/{subcat_id}','Admin\CategoryController@ActiveSubcat');
// ======================================= Sub-sub-Category =================================
Route::get('admin/sub-sub-categories','Admin\CategoryController@SubSubCatindex')->name('sub-sub-category.page');
Route::post('admin/sub-sub-categories-add','Admin\CategoryController@StoreSubSubCategory')->name('store.sub-sub-category');
Route::get('admin/sub-sub-categories-edit/{subsubcat_id}','Admin\CategoryController@EditSubSubCat');
Route::post('admin/sub-sub-categories-update/{subsubcat_id}','Admin\CategoryController@UpdateSubSubCat');
Route::get('admin/sub-sub-categories-delete/{subsubcat_id}','Admin\CategoryController@DeleteSubSubCat');
Route::get('admin/sub-sub-categories-inactive/{subcat_id}','Admin\CategoryController@InactiveSubSubcat');
Route::get('admin/sub-sub-categories-active/{subcat_id}','Admin\CategoryController@ActiveSubSubcat');
Route::get('get/subcat/{category_id}','Admin\CategoryController@GetSubCatajax');
// ================================== Products ============================================= 
Route::get('admin/products-add','Admin\ProductController@AddProduct')->name('add-products');
// get sub category by ajax 
Route::get('get/subcategory/{category_id}','Admin\ProductController@GetSubCat');
// get sub-sub-category by ajax 
Route::get('get/subsubcategory/{subcategory_id}','Admin\ProductController@GetSubSubCat');
Route::post('admin/products-store','Admin\ProductController@StoreProducts')->name('store.products');
Route::get('admin/products-manage','Admin\ProductController@ManageProduct')->name('manage-products');
Route::get('admin/products-view/{product_id}/{slug}','Admin\ProductController@ViewProducts');
Route::get('admin/products-edit/{product_id}/{slug}','Admin\ProductController@EditProducts');
Route::post('admin/products-update-without-image/{product_id}','Admin\ProductController@WithoutImgUpdt');
Route::post('admin/products-update-with-image/{product_id}','Admin\ProductController@WithImgUpdt');
Route::get('admin/products-delete/{product_id}','Admin\ProductController@Delete');
Route::get('admin/products-inactive/{product_id}','Admin\ProductController@Inactive');
Route::get('admin/products-active/{product_id}','Admin\ProductController@Active');
// product comment or review 
Route::get('admin/products-review','Admin\ProductController@reviewProducts')->name('review-products');
Route::get('admin/products-review/delete/{product_id}','Admin\ProductController@deleteProduct');
// ======================================== stock management ===================== 
Route::get('admin/stock-products','Admin\StockController@index')->name('stock.page');
// ====================================== Coupon ================================= 
Route::get('admin/coupons-add','Admin\CouponController@index')->name('coupon.page');
Route::post('admin/coupons-store','Admin\CouponController@StoreCoupon')->name('store.coupon');
Route::get('admin/coupon-edit/{coupon_id}','Admin\CouponController@Edit');
Route::post('admin/coupons-update','Admin\CouponController@Update')->name('update.coupon');
Route::get('admin/coupon-delete/{coupon_id}','Admin\CouponController@Delete');
// ============================================ Blogs ================================ 
// ======================== Blog category ===============
Route::get('admin/blogs-category-add','Admin\BlogController@AddCat')->name('add-category');
Route::post('admin/blogs-category-store','Admin\BlogController@StoreCat')->name('store-blog-category');
Route::get('admin/blogs-category-edit/{cat_id}','Admin\BlogController@EditCat');
Route::post('admin/blogs-category-update/{cat_id}','Admin\BlogController@UpdateCat');
Route::get('admin/blogs-category-delete/{cat_id}','Admin\BlogController@DeleteCat');
Route::get('admin/blogs-category-inactive/{cat_id}','Admin\BlogController@InactiveCat');
Route::get('admin/blogs-category-active/{cat_id}','Admin\BlogController@ActiveCat');
// ============================== blog sub category===================================== 
Route::get('admin/blogs-sub-category-add','Admin\BlogController@AddSubCat')->name('add-sub-category');
Route::post('admin/blogs-sub-category-store','Admin\BlogController@StoreSubCat')->name('store-blog-subcategory');
Route::get('admin/blogs-sub-category-edit/{subcat_id}','Admin\BlogController@EditSubCat');
Route::post('admin/blogs-sub-category-update/{subcat_id}','Admin\BlogController@UpdateSubCat');
Route::get('admin/blogs-sub-category-delete/{subcat_id}','Admin\BlogController@DeleteSubCat');
Route::get('admin/blogs-sub-category-inactive/{subcat_id}','Admin\BlogController@InactiveSubCat');
Route::get('admin/blogs-sub-category-active/{subcat_id}','Admin\BlogController@ActiveSubCat');
// ================================== Blog post ============================== 
Route::get('admin/blogs-add-post','Admin\BlogController@addpost')->name('add-post');
// get post sub category by ajax 
Route::get('get/post/subcategory/{cat_id}','Admin\BlogController@GetBLogSubCatAjax');
Route::post('admin/blogs-post-store','Admin\BlogController@StorePost')->name('store-blog-post');
Route::get('admin/blogs-manage-post','Admin\BlogController@ManageAllPost')->name('manage-post');
Route::get('admin/blogs-post-view/{blog_id}/{slug}','Admin\BlogController@ViewPost');
Route::get('admin/blogs-post-edit/{blog_id}/{slug}','Admin\BlogController@EditPost');
Route::post('admin/blogs-post-update','Admin\BlogController@UpdatePost')->name('update-blog-post');
Route::get('admin/blogs-post-delete/{blog_id}','Admin\BlogController@DeletePost');
Route::get('admin/blogs-post-inactive/{blog_id}','Admin\BlogController@InactivePost');
Route::get('admin/blogs-post-active/{blog_id}','Admin\BlogController@ActivePost');
// --------------------------- comment ------------------------------------- 
Route::get('admin/blogs/comments','Admin\BlogController@Comment')->name('blog-comment');
Route::get('admin/blogs/comments-view/{id}','Admin\BlogController@ViewComment');
Route::get('admin/blogs/comments-delete/{id}','Admin\BlogController@deleteComment');
// ==================================== Shipping address set ================== 
Route::get('admin/shipping/division-add','Admin\DivisionController@divPage')->name('add-division');
Route::post('admin/shipping/division-store','Admin\DivisionController@divStore');
Route::get('admin/shipping/division-edit/{id}','Admin\DivisionController@divEdit');
Route::post('admin/shipping/division-update/{id}','Admin\DivisionController@divUpdate');
Route::get('admin/shipping/division-delete/id}','Admin\DivisionController@divDelete');
// -------------------------- district -------------------- 
Route::get('admin/shipping/district-add','Admin\DivisionController@disPage')->name('add-district');
Route::post('admin/shipping/district-store','Admin\DivisionController@disStore');
Route::get('admin/shipping/district-edit/{id}','Admin\DivisionController@disEdit');
Route::post('admin/shipping/district-update/{id}','Admin\DivisionController@disUpdate');
Route::post('admin/shipping/district-delete/{id}','Admin\DivisionController@disDelete');
// -------------------------------------------- state ----------------------------- 
Route::get('admin/shipping/state-add','Admin\DivisionController@statePage')->name('add-state');
// ajax get district 
Route::get('get/district/{id}','Admin\DivisionController@getDisAjax');
Route::post('admin/shipping/state-store','Admin\DivisionController@stateStore');
Route::get('admin/shipping/state-edit/{id}','Admin\DivisionController@stateEdit');
Route::post('admin/shipping/state-update/{id}','Admin\DivisionController@stateUpdate');
Route::post('admin/shipping/state-delete/{id}','Admin\DivisionController@stateDelete');
// ========================= orders =======================================
// pending orders 
Route::get('admin/orders/new-pending-orders','Admin\OrderController@pendingOrders')->name('new-orders');
Route::get('admin/orders/pending-order/view/{order_id}','Admin\OrderController@pendingOrdersView');
Route::post('admin/orders-cancel/{order_id}','Admin\OrderController@cancelOrder');
Route::post('admin/orders/pending-order/confirm/{order_id}','Admin\OrderController@pendingOrdersConfirm');
// confirm orders 
Route::get('admin/confirm-orders','Admin\OrderController@confrimIndex')->name('confirm-orders');
Route::get('admin/confirm-orders/view/{order_id}','Admin\OrderController@confrimView');
Route::post('admin/confirm-orders/process/{order_id}','Admin\OrderController@confirmToProcess');
// processing orders 
Route::get('admin/processing-orders','Admin\OrderController@processIndex')->name('processing-orders');
Route::get('admin/processing-orders/view/{order_id}','Admin\OrderController@processView');
Route::post('admin/processing-orders/picked/{order_id}','Admin\OrderController@processToPicked');
// picked orders 
Route::get('admin/picked-orders','Admin\OrderController@pickedIndex')->name('picked-orders');
Route::get('admin/picked-orders/view/{order_id}','Admin\OrderController@pickedView');
Route::post('admin/picked-orders/shipped/{order_id}','Admin\OrderController@pickedToShipped');
// shipped orders 
Route::get('admin/shipped-orders','Admin\OrderController@shippedIndex')->name('shipped-orders');
Route::get('admin/shipped-orders/view/{order_id}','Admin\OrderController@shippedView');
Route::post('admin/shipped-orders/delivered/{order_id}','Admin\OrderController@shippedToDevlivered');
// delivered orders 
Route::get('admin/delivered-orders','Admin\OrderController@deliveredIndex')->name('delivered-orders');
Route::get('admin/delivered-orders/view/{order_id}','Admin\OrderController@deliveredView');
// ------------- order invoice ---------------
Route::get('admin/order/invoice/{order_id}','Admin\OrderController@invoicePdf');
// cancel orders 
Route::get('admin/cancel-orders','Admin\OrderController@cancelIndex')->name('cancel-orders');
Route::get('admin/cancel-orders/view/{order_id}','Admin\OrderController@cancelView');
// ---------- return order--------------
// pending orders 
Route::get('admin/return-request-orders','Admin\OrderController@retunRequestIndex')->name('return-request-orders');
Route::get('admin/return-request-orders/view/{order_id}','Admin\OrderController@pendingOderView');
Route::get('admin/return-request-orders/accept/{order_id}','Admin\OrderController@pendingOderAccept');
Route::get('admin/return-request-orders/cancel/{order_id}','Admin\OrderController@pendingOderCancel');
// return connfirm order 
Route::get('admin/return-confirmed-orders','Admin\OrderController@retunConfirmIndex')->name('return-confirmed-orders');
Route::get('admin/return-confirmed-orders/view/{order_id}','Admin\OrderController@returnConfirmView');
// return cancel orders
Route::get('admin/return-cancel-orders','Admin\OrderController@retunCancelIndex')->name('return-cancel-orders');
Route::get('admin/return-cancel-orders/view/{order_id}','Admin\OrderController@returnCancelView');
// ============================================= Reports ==================================== 
Route::get('admin/report/todays-order','Admin\ReportController@todaysOrder')->name('todays-orders');
Route::get('admin/reports/order-view/{order_id}','Admin\ReportController@reportOrderView');
Route::get('admin/report/this-month-order','Admin\ReportController@thismonthOrders')->name('this-month-orders');
Route::get('admin/report/this-year-order','Admin\ReportController@thisYearOrders')->name('this-year-orders');
Route::get('admin/report/search-order','Admin\ReportController@searchOrders')->name('search-orders');
// search orders 
Route::post('admin/search-order-date','Admin\ReportController@searchOrderDate')->name('search-order-date');
Route::post('admin/search-order-month','Admin\ReportController@searchOrderMonth')->name('search-order-month');
Route::post('admin/search-order-year','Admin\ReportController@searchOrderYear')->name('search-order-year');
// ============ newsletter subscirber list
Route::get('admin/subscriber/list','Admin\SubscriberController@subPage')->name('subscirber.page');
Route::get('admin/subscriber/delete/{id}','Admin\SubscriberController@destroy');
// ================================= testimonial ============================= 
Route::get('admin/testimonial/','Admin\TestimonialController@create')->name('testimonial.page');
Route::Post('admin/testimonial/store','Admin\TestimonialController@store')->name('store.testimonial');
Route::get('admin/testimonial-edit/{id}','Admin\TestimonialController@edit');
Route::Post('admin/testimonial/update','Admin\TestimonialController@update')->name('testimonial.update');
Route::get('admin/testimonial-delete/{id}','Admin\TestimonialController@destroy');
// ================ admin profile ============== 
Route::get('admin/profile','Admin\ProfileController@adminProfile');
Route::post('admin/profile-update','Admin\ProfileController@updateProfile');
Route::get('admin/password','Admin\ProfileController@password');
Route::post('admin/password-update','Admin\ProfileController@passUpdate');
// ============= show all users online or Offline =============== 
Route::get('admin/all-user','Admin\ProfileController@allUsers');
Route::get('admin/user-delete/{user_id}','Admin\ProfileController@userDelete');
Route::get('admin/user-banned/{user_id}','Admin\ProfileController@bannedUser');
Route::get('admin/user-unban/{user_id}','Admin\ProfileController@unbanUser');
// ===============  settings =================== 
Route::get('admin/seo/setting','Admin\SeoController@index')->name('seo-setting');
Route::post('admin/seo/update','Admin\SeoController@update')->name('seo-update');
Route::get('admin/site/setting','Admin\SettingController@index')->name('site-setting');
Route::post('admin/site/update','Admin\SettingController@update')->name('setting-update');
// =============== message ================ 
// Route::get('admin/message/all/ajax','Admin\MessageController@getAllMsgAjax');
Route::get('admin/inbox/message','Admin\MessageController@allMessage');
Route::get('admin/message/view/{msg_id}','Admin\MessageController@viewMsg');
Route::get('admin/trash/message','Admin\MessageController@trashMessage');
Route::get('admin/trash/message/delete/{msg_id}','Admin\MessageController@trashMsgDel');




// ================================ fontend Routes ==============================
// ==================== user profile ==================================
Route::group(['middleware'=> ['auth','isUser']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::post('user/profile-update','Fontend\ProfileController@updateProfile');
    Route::get('user/password','Fontend\ProfileController@passPage');
    Route::post('user/password-update','Fontend\ProfileController@passUpdate');
    Route::get('user/orders','Fontend\ProfileController@myOrders');
    Route::get('user/view/orders/{id}','Fontend\ProfileController@orderView');
    Route::get('user/return/order','Fontend\ProfileController@retunrOrderIndex');
    Route::Post('user/return-request/order/{order_id}','Fontend\ProfileController@retunrOrderRequest');
    Route::get('user/view/return-orders/{order_id}','Fontend\ProfileController@retunrOrderView');
    // ------- user invoice ---------------- 
    Route::get('user/order/invoice/{order_id}','Fontend\ProfileController@invoiceDownload');
});

Route::get('product-details/{product_id}/{product_slug}','Fontend\ProductController@DetailsPage');
// Blog Page 
Route::get('blog','Fontend\BlogsdetailsController@blogPage');
Route::post('blog/search/result','Fontend\BlogsdetailsController@search')->name('blog-search');
Route::get('blog/subcategory/{id}/{slug}','Fontend\BlogsdetailsController@showSubcatWiseBlog');
// ================================= fontend blog show details ================== 
Route::get('blog/post-deatils/{blog_id}/{blog_slug}','Fontend\BlogsdetailsController@ViewPost');
Route::post('blogs/comment/{id}','Fontend\BlogcommentController@StoreComment');
// ----------------------- contact page --------------------------------
Route::get('contact-us','Fontend\ContactController@contactPage');
Route::post('send/message','Fontend\ContactController@sendMessage');
// -------------------------------- cart -------------------------- 
// ajax 
// poduct view modal
Route::get('/cart/product/view/{id}','Fontend\CartController@viewProduct');
// add to cart 
Route::post('cart/store/data/{product_id}','Fontend\CartController@addCart');
// show header product with ajax 
Route::get('/show/cart/product/header','Fontend\CartController@showProduct');
Route::get('cart/remove/product/{cart_id}','Fontend\CartController@removeItem');
Route::get('cart/page','Fontend\CartController@cartShowPage');
// Route::post('cart/update','Fontend\CartController@updateCart');
// cart page cart increment decrement with ajax
Route::get('/cart/quantity/decrement/{cart_id}','Fontend\CartController@decrementCart');
Route::get('/cart/quantity/increment/{cart_id}','Fontend\CartController@incrementCart');
// ------------------ coupon ------------ -------
Route::post('coupon/apply','Fontend\CartController@ApplyCoupon');
Route::get('/get/coupon/calculation','Fontend\CartController@couponCalculation');
Route::get('coupon/remove','Fontend\CartController@removeCoupon');
// ------------------ checkout -------------------
Route::get('checkout','Fontend\CheckoutController@checkoutPage');
Route::get('checkout/get/district/{id}','Fontend\CheckoutController@getDisAjax');
Route::get('checkout/get/state/{id}','Fontend\CheckoutController@getStateAjax');
Route::post('payment/process','Fontend\PaymentController@paymentPage')->name('payment.process');
Route::post('/rocket/order/store','Fontend\Payment\RocketController@rocketOrderStore');
Route::post('/bkash/order/store','Fontend\Payment\BkashController@bkashOrderStore');
//----------------------stripe----------
Route::post('stripe/charge','Fontend\Payment\StripeController@stripeOrderStore')->name('stripe.charge');

// =================== wishlist ================= 
// add with ajax 
Route::get('add/wishlist/{id}','Fontend\WishlistController@Store');
Route::get('my/wishlist','Fontend\WishlistController@wishlistPage')->name('wishlist.page');
Route::get('wishlist/remove-item/{id}','Fontend\WishlistController@Delete');
// ===================== subcategory wise product show =================== 
Route::get('subcategory/products/{subcat_id}/{subcat_slug}','Fontend\CatWiseProuctController@subCatProducts');
Route::get('brand/products/{brand_id}/{brand_slug}','Fontend\CatWiseProuctController@brandProducts');
Route::get('sub-subcategory/products/{id}/{slug}','Fontend\CatWiseProuctController@subsubProducts');
// tags wise product show 
Route::get('product/tag/{tag}','Fontend\CatWiseProuctController@tagWiseProduct');
// search 
Route::Post('search/result','Fontend\SearchController@searchProduct')->name('search');
// ========= product comment ======== 
Route::post('product/comment/store','Fontend\CommentController@productComment')->name('product-comment');
// order track 
Route::Post('order/track','Fontend\TrackingController@oderTrack');
// subsribe newsletter 
Route::Post('newsletter/subscribe-store','Fontend\NewsletterController@subscirbe');
// ================================== Multiple Langugage ==========================
Route::get('language/bangla','LanguageController@Bangla')->name('language.bangla');
Route::get('language/english','LanguageController@English')->name('language.english');
Route::get('/invoice','LanguageController@invoice');

// Socialite
// login with google & Facebook
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
