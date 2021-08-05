<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\OccupantsController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard',function(){
//     return view('dashboard.accountdashboard');
// });

// Route::group(['middleware' => ['auth']], function() { 
//     Route::get('/dashboard', [DashboardController::class,'index']);
// });


//route to authentication for all user 
Route::get('/auth',[DashboardController::class,'login']);
//delta route to all other pages 
Route::get('/Dashboard',[DashboardController::class,'index']);

Route::middleware(['web','role:caretaker'])->prefix('Dashboard')->group(function(){
    Route::get('allOccupants',[OccupantsController::class,'index'])->name('Dashboard.allOccupants');
    Route::post('/createOccupant',[OccupantsController::class,'store'])->name('Dashboard.createOccupant');
    Route::post('/deleteOccupant/{id}',[OccupantsController::class,'destroy'])->name('Dashboard.deleteOccupant');
<<<<<<< HEAD
    Route::post('/updateOccupant/{id}',[OccupantsController::class,'update'])->name('Dashboard.updateOccupant');
    Route::get('/showOccupant/{id}',[OccupantsController::class,'show'])->name('Dashboard.showOccupant');
    Route::get('/deleteShow/{id}',[OccupantsController::class,'deleteShow'])->name('Dashboard.deleteShow');
    
  
    //Route::get('',[CaretakerController::class,'index']);
=======
    Route::post('/updateOccupant/{id}',[OccupantsController::class,'edit'])->name('Dashboard.updateOccupant');
    Route::get('/editOccupant/{id}',[OccupantsController::class,'show'])->name('Dashboard.editOccupant');
>>>>>>> 39003c79419a68371e0ff87f3bfb588428eacac8
});
// Route::middleware(['auth','role:occupant'])->prefix('Dashboard')->group)(function(){
   
// });
<<<<<<< HEAD
=======


/**Normal user login */
Route::get('/user',[DashboardController::class,'userLogin']);
Route::get('/userRegister',[DashboardController::class,'userRegister']);
>>>>>>> 39003c79419a68371e0ff87f3bfb588428eacac8

