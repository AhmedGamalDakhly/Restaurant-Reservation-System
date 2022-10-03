<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NewReservationRequest;
use App\Models\Meal;
use App\Models\Reservation;
use App\Models\Table;
use App\Rules\DateBetweenRule;
use App\Rules\TimeBetweenRule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontReservationController extends Controller
{
    public function create(){
        $data['tables']=Table::all();
        $data['meals']=Meal::all();
        $data['min_date']=Carbon::today();
        $data['max_date']=Carbon::now()->addMonth();
        $data['reservations']=Reservation::where('email',auth()->user()->email)->get();
        return view('front.reservations.create',$data);
    }

    public function store(Request $request){

        $reservationData=$request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'res_date' => ['required', 'date',New DateBetweenRule() , New TimeBetweenRule()],
            'tel_number' => ['required'],
            'table_id' => ['required','exists:tables,id'],
            'guest_number' => ['required', 'integer'],
            'meals' => ['required'],
        ]);
        $reservedGuestNum=$request->guest_number;
        $reservedTable=Table::where('id',$request->table_id)->first();
        $reservationData['email']=auth()->user()->email;
        if($reservedGuestNum > $reservedTable->guest_number){
            return back()->withInput()->withErrors(['table_id'=>'pls select a table with proper guest number to fit them']);
        }
        if(!$reservedTable->isAvailableForDate($request->res_date)){
            return back()
                ->withInput()
                ->withErrors(['res_date'=>'table already reserved for this date! pls choose another date or another table pls ']);
        }
        $reservation=Reservation::create($reservationData);
        return view('thanks',compact('reservation'));
    }
    public function destroy(Request $request,$id){
        $reservation=Reservation::where('id',$id)->first();
        $email=auth()->user()->email;
        if ($reservation->email==$email){
            $reservation->delete();
        }
        $data['reservations']=Reservation::where('email',$email)->get();
        $data['tables']=Table::all();
        $data['meals']=Meal::all();
        $data['min_date']=Carbon::today();
        $data['max_date']=Carbon::now()->addMonth();
        return to_route('reservations.create');
    }
}
