<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Wishlist;
use App\Cart;
use App\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    
    public function Store($id){
        $check_wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$id)->first();
        $check_Cart = Cart::where('ip_address',request()->ip())->where('product_id',$id)->first();
        if (Auth::check()) {
            if ($check_Cart) {
                return response()->json(['error' => 'Product Already has on your Cart']);
            }elseif ($check_wishlist) {
                return response()->json(['error' => 'Product Already has on your wishlist']);
            }else{
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully Added on your wishlist']);
            }
        }else{
            
            return  response()->json(['error' => 'You Need To login your account']);

        }
    }

    // ---------------------------- wishlist page show ---------------------------- 
    public function wishlistPage(){
        
        $sum = Wishlist::latest()->sum('id');
       
        if ($sum !== 0) {
            $products = Product::latest()->where('status',1)->get();
            $wishlists = Wishlist::latest()->get();
            return view('pages.wishlist',compact('wishlists','products'));
        }else{
            $notification=array(
                'message'=>'No Product Your Wishlist,Add Now',
                'alert-type'=>'error'
            );
            return Redirect()->to('/')->with($notification);
        }
     
    }

    // ------------------ delete product from wishlist ------------- 
    public function Delete($id){
        Wishlist::Where('id',$id)->where('user_id',Auth::id())->delete();
        return Redirect()->back();
    }
        
    
}
