<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Food;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  View
     */
    public function index()
    {
        $data['meals']= Meal::all();
        foreach ($data['meals'] as $meal){
            $meal['foods']= Food::whereIn('id',$meal->foods)->get('name');
        }
        return view('admin.meals.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $foods=Food::all('name','id');
        return view('admin.meals.create',compact('foods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $image= $request->file('image')->store('/meals');

        Meal::create([
                'name' => $request->name,
                'image' => $image,
                'description' => $request->description,
                'price' =>  $request->price,
                'count' =>  $request->count,
                'foods' =>  $request->get('foods'),
            ]
        );
        return redirect()->route('admin.meal.index')->with('success','Meal created successfully');;
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['meal']=Meal::where('id',$id)->first();
        $data['activeFoods']=$data['meal']->activeFoods();
        $data['inActiveFoods']=$data['meal']->inActiveFoods();
        return view('admin.meals.edit',$data);
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
        $currentMeal=Meal::where('id',$id)->first();
        $image=$currentMeal->image;
        if($request->hasFile('image')){
            Storage::delete($image);
            $image= $request->file('image')->store('/meals');
        }
        $currentMeal->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'price' => $request->price,
            'count' => $request->count,
            'foods' => $request->foods,
        ]);
        return to_route('admin.meal.index')->with('warning','Meal updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $currentMeal=Meal::where('id',$id)->first();
        $image=$currentMeal->image;
        Storage::delete($image);
        $currentMeal->delete();
        return to_route('admin.meal.index')->with('danger','Meal deleted successfully');;

    }
}
