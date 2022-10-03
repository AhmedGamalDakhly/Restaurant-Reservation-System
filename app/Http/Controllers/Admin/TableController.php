<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewTableRequest;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  View
     */
    public function index()
    {
        $data['tables']= Table::all();
        return view('admin.tables.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.tables.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewTableRequest $request)
    {
        Table::create([
                'name' => $request->name,
                'guest_number' => $request->guest_number,
                'status' => $request->status,
                'location' => $request->location,
            ]
        );
        return redirect()->route('admin.table.index')->with('success','Table created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $table=Table::where('id',$id)->first();
        return view('admin.tables.edit',compact('table'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewTableRequest $request, $id)
    {
        $currentTable=Table::where('id',$id)->first();
        $currentTable->update([
            'name' => $request->name,
            'guest_number' => $request->guest_number,
            'status' => $request->status,
            'location' => $request->location,
        ]);
        return redirect()->route('admin.table.index')->with('warning','Table updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $reservationsInTable=Reservation::where('table_id',$id)->get();
        if(!$reservationsInTable->isEmpty()){
            return redirect()->route('admin.table.index')->with('danger','Please Delete Reservations In This Table Before Deleting The Table !');
        }
        $currentTable=Table::where('id',$id)->first();
        $currentTable->delete();
        return redirect()->route('admin.table.index')->with('danger','Table deleted successfully');

    }
}
