<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Meal;
use Illuminate\Http\Request;

class FrontMealController extends Controller
{
    public function index(){
        $data['meals']=Meal::all();
        return view('front.meals.index',$data);
    }

    public function show($id){
        $data['meal']=Meal::where('id',$id)->first();
        return view('front.meals.show',$data);
    }
}
