<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewReservationRequest;
use App\Models\Meal;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return  View
     */
    public function index()
    {
        $data['reservations']= Reservation::all();
        return view('admin.reservations.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        $tables=Table::availableTables();
        $meals=Meal::all();
        return view('admin.reservations.create',compact('tables','meals'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewReservationRequest $request)
    {
        $reservedGuestNum=$request->guest_number;
        $reservedTable=Table::where('id',$request->table_id)->first();
        if($reservedGuestNum > $reservedTable->guest_number){
            return back()->withInput()->withErrors(['table_id'=>'select a table with proper guest number to fit them']);
        }
        if(!$reservedTable->isAvailableForDate($request->res_date)){
            return back()
                ->withInput()
                ->withErrors(['res_date'=>'table already reserved for this date choose another date or another table pls ']);
        }
        Reservation::create($request->validated());
        return redirect()->route('admin.reservation.index')->with('success','Reservation created successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $tables=Table::all();
        $meals=Meal::all();
        $reservation=Reservation::where('id',$id)->first();
        return view('admin.reservations.edit',compact('reservation','tables','meals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewReservationRequest $request, $id)
    {
        $reservedGuestNum=$request->guest_number;
        $reservedTable=Table::where('id',$request->table_id)->first();
        if($reservedGuestNum > $reservedTable->guest_number) {
            return back()->withInput()->withErrors(['table_id' => 'select a table with proper guest number to fit them']);
        }
        $currentReservation=Reservation::where('id',$id)->first();
        $currentReservation->update($request->validated());
        return redirect()->route('admin.reservation.index')->with('warning','Reservation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $currentReservation=Reservation::where('id',$id)->first();
        $currentReservation->delete();
        return redirect()->route('admin.reservation.index')->with('danger','Reservation deleted successfully');
    }
}
