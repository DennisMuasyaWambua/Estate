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

Route::middleware(['auth','role:caretaker'])->prefix('Dashboard')->group(function(){
    Route::get('allOccupants',[OccupantsController::class,'index'])->name('Dashboard.allOccupants');
    Route::post('/createOccupant',[OccupantsController::class,'store'])->name('Dashboard.createOccupant');
    Route::post('/deleteOccupant/{id}',[OccupantsController::class,'destroy'])->name('Dashboard.deleteOccupant');
    Route::get('/updateOccupant/{id}',[OccupantsController::class,'edit'])->name('Dashboard.updateOccupant');
    Route::get('/showOccupant/{id}',[OccupantsController::class,'show'])->name('Dashboard.showOccupant');
    
  
    //Route::get('',[CaretakerController::class,'index']);
});
// Route::middleware('auth')->group(function(){
//     Route::get('/Dashboard',[DashboardController::class,'index']);
//     Route::get('/Dashboard',[CaretakerController::class,'index']);
// });
/** care taker routes */
Route::get('/caretaker',[DashboardController::class,'loginCareTaker']);
Route::get('/caretakerRegister', [DashboardController::class,'registerCaretaker']);

/**Normal user login */
Route::get('/user',[DashboardController::class,'userLogin']);
Route::get('/userRegister',[DashboardController::class,'userRegister']);

