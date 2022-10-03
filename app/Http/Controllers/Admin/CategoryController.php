<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewCategoryRequest;
use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  View
     */
    public function index()
    {
        $data['categories']= Category::all();
        return view('admin.categories.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewCategoryRequest $request)
    {
        $image= $request->file('image')->store('/categories');
        Category::create([
                'name' => $request->name,
                'image' => $image,
                'description' => $request->description,
            ]
        );
        return redirect()->route('admin.category.index')->with('success','Category created successfully');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $data['category']=Category::where('id',$id)->first();
        return view('admin.categories.edit',$data);
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
        $currentCategory=Category::where('id',$id)->first();
        $image=$currentCategory->image;
        if($request->hasFile('image')){
            Storage::delete($image);
            $image= $request->file('image')->store('/categories');
        }
        $currentCategory->update([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);
        return redirect()->route('admin.category.index')->with('warning','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $foodsInCategory=Food::where('category_id',$id)->get();
        if(!$foodsInCategory->isEmpty()){
            return redirect()->route('admin.category.index')->with('danger','Please Delete Foods In This Category Before Deleting The Category !');
        }
        $currentCategory=Category::where('id',$id)->first();
        Storage::delete($currentCategory->image);
        $currentCategory->delete();
        return redirect()->route('admin.category.index')->with('danger','Category deleted successfully');
    }
}
