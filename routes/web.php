<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\MealController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Front\FrontCategoryController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\FrontMealController;
use App\Http\Controllers\Front\FrontReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/*Routes for the frontend users*/
Route::get('/', [FrontHomeController::class, 'index'])->name('home');;
Route::get('/thanks', [FrontHomeController::class, 'thanks'])->name('thanks');
Route::get('/categories', [FrontCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [FrontCategoryController::class, 'show'])->name('categories.show');
Route::get('/meals', [FrontMealController::class, 'index'])->name('meals.index');
Route::get('/meals/{meal}', [FrontMealController::class, 'show'])->name('meals.show');



/*Routes for authenticated guests */
Route::middleware('auth')->group(function (){
    Route::get('/reservation/create', [FrontReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservation/store', [FrontReservationController::class, 'store'])->name('reservations.store');
    Route::delete('/reservation/destroy/{id}', [FrontReservationController::class, 'destroy'])->name('reservations.destroy');

});

/*Routes for the Admin Panel*/
Route::middleware('auth','admin')->name('admin.')->prefix('admin')->group(function (){
    Route::get('/',[AdminController::class,'index'])->name('index');
    Route::resource('/category',CategoryController::class);
    Route::resource('/meal',MealController::class);
    Route::resource('/food',FoodController::class);
    Route::resource('/reservation',ReservationController::class);
    Route::resource('/table',TableController::class);
});

require __DIR__.'/auth.php';


