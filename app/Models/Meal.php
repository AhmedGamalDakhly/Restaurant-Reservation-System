<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;
    protected $fillable=['name','description','image','price','count','foods'];

    protected $casts=[
        'foods' => 'array',
    ];
    /**
     * get foods included in this meal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function activeFoods(){
        $foodsIDs=$this->foods;
        $activeFoods=Food::whereIn('id',$foodsIDs)->get();
        return $activeFoods;
        }
    /**
     * get foods that is not included in this meal.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function inActiveFoods(){
        $foodsIDs=$this->foods;
        $inActiveFoods=Food::whereNotIn('id',$foodsIDs)->get();
        return $inActiveFoods;
    }


}
