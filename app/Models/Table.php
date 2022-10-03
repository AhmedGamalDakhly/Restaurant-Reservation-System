<?php

namespace App\Models;

use App\Enums\TableLocation;
use App\Enums\TableStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'guest_number', 'status', 'location'];

    /**
     * get table that are available.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public static function availableTables(){
        return Table::where('status','available')->get();
    }


    /**
     * get date and time that this table is reserved at.
     *
     * @return array
     */

    public function reservedDatesAndTimes(){
        $tableReservations=$this->reservations;
        $reservedDates=array();
        foreach ($tableReservations as $reservation){
            $reservedDates[] = Carbon::parse($reservation->res_date);
        }
        return $reservedDates;
    }

    /**
     * check that this table is available to be reserved for that date.
     *@param String $value
     * @return false
     */
    public function isAvailableForDate($value){
        $selectedDate=Carbon::parse($value);
        $reservedDates= $this->reservedDatesAndTimes();
        foreach ($reservedDates as $reservedDate){
            $reservedDatePlusHour= Carbon::parse($reservedDate)->addHour();
            if( $selectedDate->eq($reservedDate) or $selectedDate->between($reservedDate, $reservedDatePlusHour) ){
                return false;
            }
        }
        return true;

    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class,'table_id','id');
    }


}
