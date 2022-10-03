<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    public function index(){
        return view('index');
    }

    public function thanks(){
        return view('thanks');
    }
}
