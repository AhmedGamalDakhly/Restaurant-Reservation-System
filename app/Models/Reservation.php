<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'tel_number',
        'email',
        'table_id',
        'res_date',
        'guest_number',
        'meals'
    ];

    protected $dates = [
        'res_date'
    ];

    protected $casts=[
      'meals' => 'array'
    ];


    /**
     * get meals selected for this reservation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeMeals(){
        $mealIDs=$this->meals;
        $activeMeals=Meal::whereIn('id',$mealIDs)->get();
        return $activeMeals;
    }
    /**
     * get meals not selected for this reservation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inActiveMeals(){
        $mealIDs=$this->meals;
        $inActiveMeals=Meal::whereNotIn('id',$mealIDs)->get();
        return $inActiveMeals;
    }

    /**
     * get the table selected for this reservation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
