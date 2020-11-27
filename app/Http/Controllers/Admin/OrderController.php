<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Orderdetail;
use Carbon\Carbon;
use App\Shipping;
use App\Product;
use PDF;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    //----------- new pending orders ---------------
    public function pendingOrders(){
        $orders = Order::where('status',0)->latest()->get();
        return view('admin.order.pending.index',compact('orders'));
    }

    // ------------------ pending order view ---------------- 
    public function pendingOrdersView($order_id){
   
        $order = Order::where('status',0)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.pending.view',compact('order','shipping','order_details'));
    }

    // cancel orders 
    public function cancelOrder(Request $request,$order_id){
        $request->validate([
            'cancel_reason' => 'required'
        ],[
            'cancel_reason.required' => 'order cancel reason field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'cancel_reason'=> $request->cancel_reason,
            'status'=> 6,
            'cancel_date'=> Carbon::now()
            ]);

        $notification=array(
            'message'=>'Order Cancel Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('new-orders')->with($notification);
    }

    // --------------- pending order confirm 
    public function pendingOrdersConfirm(Request $request,$order_id){
        $request->validate([
            'confirmed_by' => 'required'
        ],[
            'confirmed_by.required' => 'order confirmed by field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'confirmed_by'=> $request->confirmed_by,
            'status'=> 1,
            'confirmed_date'=> Carbon::now()
            ]);

    //  decrement product stock quantity 
    $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        foreach ($order_details as $row) {
            Product::where('id',$row->product_id)->decrement('product_quantity',$row->quantity);
        }
          
        $notification=array(
            'message'=>'Order Confirmation Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('new-orders')->with($notification);
    }

    // =========================== Confirm Order =========================================================
    // ======================================================================================================
    public function confrimIndex(){
        $orders = Order::where('status',1)->latest()->get();
        return view('admin.order.confirm.index',compact('orders'));
    }

    // --------------- view confirm orders ----------------------- 
    public function confrimView($order_id){
        
        $order = Order::where('status',1)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.confirm.view',compact('order','shipping','order_details'));
    }

    // confirm order to process order 
    public function confirmToProcess(Request $request,$order_id){
        $request->validate([
            'processing_by' => 'required'
        ],[
            'processing_by.required' => 'order processing by field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'processing_by'=> $request->processing_by,
            'status'=> 2,
            'processing_date'=> Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Send To Processing',
            'alert-type'=>'success'
        );
        return Redirect()->route('confirm-orders')->with($notification);
    }
    // ============================================ Processing Orders ============================== 
    public function processIndex(){
        $orders = Order::where('status',2)->latest()->get();
        return view('admin.order.processing.index',compact('orders'));
    }

    // view processing orders 
    public function processView($order_id){
        $order = Order::where('status',2)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.processing.view',compact('order','shipping','order_details'));
    }

    // processing to picked orders 
    public function processToPicked(Request $request,$order_id){
        $request->validate([
            'picked_by' => 'required'
        ],[
            'picked_by.required' => 'order picked by field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'picked_by'=> $request->picked_by,
            'status'=> 3,
            'picked_date'=> Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Picked Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('processing-orders')->with($notification);
    }

    // ==================================== picked orders ============================== 
    public function pickedIndex(){
        $orders = Order::where('status',3)->latest()->get();
        return view('admin.order.picked.index',compact('orders'));
    }

    // ---------------------- view picked orders -------------------------- 
    public function pickedView($order_id){
        $order = Order::where('status',3)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.picked.view',compact('order','shipping','order_details'));
    }

    // picked to shipped orders 
    public function pickedToShipped(Request $request,$order_id){
        $request->validate([
            'shipped_by' => 'required'
        ],[
            'shipped_by.required' => 'order shipped field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'shipped_by'=> $request->shipped_by,
            'status'=> 4,
            'shipped_date'=> Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Shipped Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('picked-orders')->with($notification);
    }

    // =============================== Shipped Orders ========================== 
    public function shippedIndex(){
        $orders = Order::where('status',4)->latest()->get();
        return view('admin.order.shipped.index',compact('orders'));
    }

    // shipped orders view ---------------
    public function shippedView($order_id){
        $order = Order::where('status',4)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.shipped.view',compact('order','shipping','order_details'));
    }

    // shipped to delivery products 
    public function shippedToDevlivered(Request $request,$order_id){
        $request->validate([
            'delivered_by' => 'required'
        ],[
            'delivered_by.required' => 'order delivered field is required'
        ]);
        $order = Order::findOrFail($order_id)->update([
            'delivered_by'=> $request->delivered_by,
            'status'=> 5,
            'delivered_date'=> Carbon::now()
            ]);
        $notification=array(
            'message'=>'Order Delivered Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('shipped-orders')->with($notification);
    }

    // =================== delivered orders ===================== ====================================
    public function deliveredIndex(){
        $orders = Order::where('status',5)->latest()->get();
        return view('admin.order.delivered.index',compact('orders'));
    }

    // view delivered orders 
    public function deliveredView($order_id){
        $order = Order::where('status',5)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.delivered.view',compact('order','shipping','order_details'));
    }

    // -------------- invoice make ------------
    public function invoicePdf($order_id){
        $order = Order::findOrFail($order_id);
        $order_details = Orderdetail::with('product')->where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::with('division','district','state')->where('order_id',$order_id)->first();
        $pdf = PDF::loadView('admin.invoice.invoice', compact('order','order_details','shipping'));
        // return $pdf->download('invoice.pdf');
        return $pdf->stream('invoice.pdf');
    }

    // ================================= cancel orders =================================== 
    // =================================================================================== 
    public function cancelIndex(){
        $orders = Order::where('status',6)->latest()->get();
        return view('admin.order.cancel.index',compact('orders'));
    }

    // ----------------- cancel orders ------------------ 
    public function cancelView($order_id){
        $order = Order::where('status',6)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.order.cancel.view',compact('order','shipping','order_details'));

    }

    // ======================= Return Orders =========================================== 
    // ======================================================================== 
    public function retunRequestIndex(){
        $orders = Order::where('status',5)->where('return_order_status',1)->latest()->get();
        return view('admin.return-order.pending.index',compact('orders'));
    }

    // ------------- view pending request orders ------------------- 
    public function pendingOderView($order_id){
        $order = Order::where('status',5)->where('return_order_status',1)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.return-order.pending.view',compact('order','shipping','order_details'));
    }

    // accept pending return ordrs 
    public function pendingOderAccept($order_id){
        $order = Order::findOrFail($order_id)->update([
            'return_order_status' => 2,
            'return_accept_date' => Carbon::now(),
            'return_accept_month' => Carbon::now()->format('F'),
            'return_accept_year' => Carbon::now()->format('Y'),
            ]);
        $notification=array(
            'message'=>'Order Accept Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('return-request-orders')->with($notification);
    }

      // cancel pending return ordrs 
      public function pendingOderCancel($order_id){
        $order = Order::findOrFail($order_id)->update([
            'return_order_status' => 3,
            ]);
        $notification=array(
            'message'=>'Order Cancel Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('return-request-orders')->with($notification);
    }

    // ============================= Return ordrs accept or confirmed ================== 
    public function retunConfirmIndex(){
        $orders = Order::where('status',5)->where('return_order_status',2)->latest()->get();
        return view('admin.return-order.confirmed.index',compact('orders'));
    }

    // view 
    public function returnConfirmView($order_id){
        $order = Order::where('status',5)->where('return_order_status',2)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.return-order.confirmed.view',compact('order','shipping','order_details'));
    }

    // ---------- return cancel orders ===============================
    public function retunCancelIndex(){
        $orders = Order::where('status',5)->where('return_order_status',3)->latest()->get();
        return view('admin.return-order.cancel.index',compact('orders'));
    }

    // view return cancel orders 
    public function returnCancelView($order_id){
        $order = Order::where('status',5)->where('return_order_status',3)->where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.return-order.cancel.view',compact('order','shipping','order_details'));
    }


}
