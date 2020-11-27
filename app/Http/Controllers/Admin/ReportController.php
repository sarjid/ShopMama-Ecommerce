<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use App\Orderdetail;
use App\Shipping;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

//    ========= Today orders ================= 
    public function todaysOrder(){
        
        $orders = Order::where('order_date',Carbon::now()->format('d F Y'))->latest()->get();
        return view('admin.report.todays-order.index',compact('orders'));
    }

    // =============== report order view ================= 
    public function reportOrderView($order_id){
        $order = Order::where('id',$order_id)->first();
        $order_details = Orderdetail::where('order_id',$order_id)->latest()->get();
        $shipping = Shipping::where('order_id',$order_id)->first();
        return view('admin.report.view',compact('order','shipping','order_details'));
    }

    // ==================== this month oders ================ 
    public function thismonthOrders(){

        $orders = Order::where('order_month',Carbon::now()->format('F'))->latest()->get();
        return view('admin.report.this-month-order.index',compact('orders'));
    }

    // this year orders 
    public function thisYearOrders(){
        $orders = Order::where('order_year',Carbon::now()->format('Y'))->latest()->get();
        $amount = Order::where('order_year',Carbon::now()->format('Y'))->sum('paying_amount');
        return view('admin.report.this-year-order.index',compact('orders','amount'));
    }

    // ============================================= search orders =========================================
    public function searchOrders(){
        return view('admin.report.search.index');
    }

    // --------- search order by date ----------- 
    public function searchOrderDate(Request $request){
        $request->validate([
            'search_date' => 'required'
        ]);
        
        $date = $request->search_date;
        $newdate = new DateTime($date);
        $getDate = $newdate->format('d F Y');
        $orders = Order::where('order_date',$getDate)->latest()->get();
        return view('admin.report.search.search-result',compact('orders'));
    }

    // ------------- search order month --------- 
    public function searchOrderMonth(Request $request){
        $request->validate([
            'month_name' => 'required',
            'year_name' => 'required'
        ]);

        $orders = Order::where('order_month',$request->month_name)->where('order_year',$request->year_name)->latest()->get();
        return view('admin.report.search.search-result',compact('orders'));
    }

    // search order by year 
    public function searchOrderYear(Request $request){
        $request->validate([
            'year_name' => 'required'
        ]);

        $orders = Order::where('order_year',$request->year_name)->latest()->get();
        return view('admin.report.search.search-result',compact('orders'));
    }

}
