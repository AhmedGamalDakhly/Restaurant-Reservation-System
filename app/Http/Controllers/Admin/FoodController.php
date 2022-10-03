<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewFoodRequest;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data['foods']= Food::all();
        return view('admin.foods.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $data['categories']= Category::all();
        return view('admin.foods.create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewFoodRequest $request)
    {
        $image= $request->file('image')->store('/foods');
        Food::create([
            'name' => $request->name,
            'image' =>  $image,
            'description' => $request->description,
            'category_id' =>  $request->category,
        ]);
        return  to_route('admin.food.index')->with('success','Food created successfully');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['categories']= Category::all();
        $data['food']=Food::where('id',$id)->first();
        return view('admin.foods.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $food=Food::where('id',$id)->first();
        $image=$food->image;
        if($request->hasFile('image')){
            Storage::delete($image);
            $image= $request->file('image')->store('/foods');
        }
        $food->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'category_id' => $request->category,
        ]);
        return to_route('admin.food.index')->with('warning','Food updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $food=Food::where('id',$id)->first();
        Storage::delete($food->image);
        $food->delete();
        return to_route('admin.food.index')->with('danger','Food deleted successfully');
    }

}
