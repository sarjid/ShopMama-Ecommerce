<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Response;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // ----------------------- cart store ------------------- 
    public function addCart(Request $request,$product_id){
        $product = Product::findOrFail($product_id);
        $extist = Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->first();
        if (!$extist) {
          if ($product->discount_price == NULL) {
            $insert = Cart::insert([
                'product_id' => $product_id,
                'color' => $request->color,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'price' => $product->selling_price,
                'ip_address' => request()->ip(),
                'created_at' => Carbon::now()
            ]);
                if(Session::has('coupon')){
                    session()->forget('coupon');
                 }           
             return response()->json(['success' => 'Successfully Added on your cart']);
          }else{
            $insert = Cart::insert([
                'product_id' => $product_id,
                'color' => $request->color,
                'size' => $request->size,
                'quantity' => $request->quantity,
                'price' => $product->discount_price,
                'ip_address' => request()->ip(),
                'created_at' => Carbon::now()
            ]);
            if(Session::has('coupon')){
                session()->forget('coupon');
             }  
             return response()->json(['success' => 'Successfully Added on your cart']);
          }

        }else{

            $carts = Cart::where('product_id',$product_id)->where('ip_address',request()->ip())->increment('quantity');
            return response()->json(['success' => 'Successfully Added on your cart']);
        }
       
    }

    // ========================== remove from cart item ========================== 
    public function removeItem($cart_id){
        Cart::where('id',$cart_id)->where('ip_address',request()->ip())->delete();
        if(Session::has('coupon')){
            $coupon = Session::get('coupon')['coupon_name'];
             $check = Coupon::where('coupon_name',$coupon)->first();
             $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                return $t->price * $t->quantity;
            });
             Session::put('coupon',[
                'coupon_name' => $check->coupon_name,
                'discount' => $check->coupon_discount,
                'coupon_balance' => round($total * ($check->coupon_discount/100)),
            ]);
         }
         return response()->json(['success' => 'Product Remove From your cart']);
    }

    // ---------------------------- cart show page --------------------------- 
    public function cartShowPage(){
        $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
            return $t->price * $t->quantity;
        });
        if ($total !== 0) {
          $carts = Cart::latest()->where('ip_address',request()->ip())->get();
          $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
              return $t->price * $t->quantity;
          });
        return view('pages.cart',compact('carts','total'));
        }else{
            if (Session::has('coupon')) {
                session()->forget('coupon');
            }
            // $notification=array(
            //     'message'=>'No Product On Your Cart,At First Shopping Now',
            //     'alert-type'=>'error'
            // );
            // return Redirect()->to('/')->with($notification);
             return Redirect()->to('/');
        }
        
    }

    // ------------------------------ update cart multiple data ------------------ 
    // public function updateCart(Request $request){
    //      $quantity = $request->qty;
    //      $colors = $request->color;
    //      $sizes = $request->size;
    //      foreach($quantity as $cart_id => $qty){
    //          Cart::where('id',$cart_id)->where('ip_address',request()->ip())->update(['quantity' => $qty]);
    //      }

    //      foreach($colors as $cart_id => $color){
    //         Cart::where('id',$cart_id)->where('ip_address',request()->ip())->update(['color' => $color]);
    //     }

    //     foreach($sizes as $cart_id => $size){
    //         Cart::where('id',$cart_id)->where('ip_address',request()->ip())->update(['size' => $size]);
    //     }
    //     if(Session::has('coupon')){
    //         $coupon = Session::get('coupon')['coupon_name'];
    //          $check = Coupon::where('coupon_name',$coupon)->first();
    //          $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
    //             return $t->price * $t->quantity;
    //         });
    //          Session::put('coupon',[
    //             'coupon_name' => $check->coupon_name,
    //             'discount' => $check->coupon_discount,
    //             'coupon_balance' => $total * ($check->coupon_discount/100),
    //         ]);
    //      }

    //     return Redirect()->back();

    // }

    // ====================== coupon =============== 
    public function ApplyCoupon(Request $request){
        $request->validate([
            'coupon' => 'max:255'
        ]);
        $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
            return $t->price * $t->quantity;
        });
     $check = Coupon::where('coupon_name',$request->coupon_name)->first();
        if ($check) {
            $coupon_validity = $check->coupon_validity >= Carbon::now()->format('Y-m-d');
            if ($coupon_validity) {
              Session::put('coupon',[
                  'coupon_name' => $check->coupon_name,
                  'discount' => $check->coupon_discount,
                  'coupon_balance' => round($total * ($check->coupon_discount/100)),
              ]); 
                return response()->json(array(
                    'coupon_validity' => $coupon_validity,
                    'success' => 'Successfully Coupon Applied'
                ));

            }else{
                return response()->json(['error' => 'Your Coupon Is Not Valid']);
                // date expire coupon 
            }
        }else{
            return response()->json(['error' => 'Your Coupon Is Not Valid']);
        }

    }

    // ============================= coupon calculation ======================= 
    public function couponCalculation(){
        if (Session::has('coupon')){
            $subtotal = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                return $t->price * $t->quantity;
            });
           $coupon_name = session()->get('coupon')['coupon_name'];
           $coupon_discount = session()->get('coupon')['discount'];
           $coupon_balance =  round(session()->get('coupon')['coupon_balance']);
           return response::json(array(
            'subtotal' => $subtotal,
            'coupon_name' => $coupon_name,
            'coupon_discount' => $coupon_discount,
             'coupon_balance' => $coupon_balance,
        ));
        }else{
            $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                return $t->price * $t->quantity;
            });

            return response::json(array(
                'total' => $total,
            ));
        }
    }

    public function removeCoupon(){
        session::forget('coupon');
        return response()->json(['success' => 'Coupon Successfully Removed']);

    }

    // ===================== view product with model with ajax ================= 
    public function viewProduct($product_id){
        $product = DB::table('products')
        ->join('categories','products.category_id','categories.id')
        ->join('subcategories','products.subcategory_id','subcategories.id')
        ->join('brands','products.brand_id','brands.id')
        ->select('products.*','categories.category_name_en','subcategories.subcategory_name_en','brands.brand_name_en')
        ->where('products.id',$product_id)
        ->first();

        $color = $product->product_color_en;
        $product_color = explode(',',$color);

        $size = $product->product_size_en;
        $product_size = explode(',',$size);

        return response::json(array(
            'product' => $product,
            'color' => $product_color,
             'size' => $product_size,
        ));
    }


    // show all product header with ajax
    public function showProduct(){
        $cart = Cart::with('product')->latest()->where('ip_address',request()->ip())->get();
        $total =Cart::all()->where('ip_address',request()->ip())->sum(function($t){
            return $t->price * $t->quantity;
        });
        $countqty = Cart::where('ip_address',request()->ip())->sum('quantity');
        return response::json(array(
            'cart' => $cart,
            'total' => $total,
            'countqty' => $countqty,
            
        ));
    } 

    // cart total 
    // public function total(){
    //     $total =Cart::all()->where('ip_address',request()->ip())->sum(function($t){
    //         return $t->price * $t->quantity;
    //     });
    //     return response()->json($total);
    // }

    // -------------- decrement cart quantity ---------------- 
    public function decrementCart($cart_id){
        $qty = Cart::where('id',$cart_id)->where('ip_address',request()->ip())->first();
        if ($qty->quantity > 1) {
            $carts = Cart::where('id',$cart_id)->where('ip_address',request()->ip())->decrement('quantity');
                if(Session::has('coupon')){
                    $coupon = Session::get('coupon')['coupon_name'];
                    $check = Coupon::where('coupon_name',$coupon)->first();
                    $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                        return $t->price * $t->quantity;
                    });
                    Session::put('coupon',[
                        'coupon_name' => $check->coupon_name,
                        'discount' => $check->coupon_discount,
                        'coupon_balance' => round($total * ($check->coupon_discount/100)),
                    ]);
                }
            return response()->json($carts);            
        }else{
            return response()->json('disabled');
        }
    }

    public function incrementCart($cart_id){
        $carts = Cart::where('id',$cart_id)->where('ip_address',request()->ip())->increment('quantity');
            if(Session::has('coupon')){
                $coupon = Session::get('coupon')['coupon_name'];
                $check = Coupon::where('coupon_name',$coupon)->first();
                $total = Cart::all()->where('ip_address',request()->ip())->sum(function($t){
                    return $t->price * $t->quantity;
                });
                Session::put('coupon',[
                    'coupon_name' => $check->coupon_name,
                    'discount' => $check->coupon_discount,
                    'coupon_balance' => round($total * ($check->coupon_discount/100)),
                ]);
            }
        return response()->json($carts);
    }
}
