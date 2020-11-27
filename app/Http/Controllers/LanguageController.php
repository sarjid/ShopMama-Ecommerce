<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Session;


class LanguageController extends Controller
{
    
    public function Bangla(){
        Session::get('language');
        session()->forget('language');
        Session::put('language','bangla');
        return Redirect()->back();
    }

    public function English(){
        Session::get('language');
        session()->forget('language');
        Session::put('language','english');
        return Redirect()->back();
    }

    public function invoice(){
        return view('mail.invoice');
    }

   

}
