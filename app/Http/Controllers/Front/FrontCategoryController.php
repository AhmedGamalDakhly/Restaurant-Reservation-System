<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontCategoryController extends Controller
{
    public function index(){
        $data['categories']=Category::all();
        return view('front.categories.index',$data);
    }

    public function show($id){
        $data['category']=Category::where('id',$id)->first();
        return view('front.categories.show',$data);
    }
}
