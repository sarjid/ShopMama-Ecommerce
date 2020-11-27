<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // ============= stock index page================= 
    public function index(){
       $products = Product::latest()->get();

       return view('admin.stock.index',compact('products'));


    }
}
