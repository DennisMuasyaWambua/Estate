<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\OccupantsController;
use App\Http\Controllers\payments\mpesa\MpesaController;

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
//getting access token
Route::get('/getAcccessToken',[MpesaController::class,'getAccessToken']);
Route::post('/registerURL',[MpesaController::class,'registerURL']);
Route::post('/simulate',[MpesaController::class,'simulateTransaction']);
Route::post('/stkpush',[MpesaController::class,'stkPush']);


//route to authentication for all user 
Route::get('/auth',[DashboardController::class,'login']);
Route::get('/auth/forgot-password',function(){return view('auth.forgot-password');});
//delta route to all other pages 
Route::get('/Dashboard',[DashboardController::class,'index'])->name('Dashboard');

Route::middleware(['web','role:caretaker'])->prefix('Dashboard')->group(function(){
    Route::get('/allOccupants',[OccupantsController::class,'index'])->name('Dashboard.allOccupants');
    Route::post('/createOccupant',[OccupantsController::class,'store'])->name('Dashboard.createOccupant');
    Route::post('/deleteOccupant/{id}',[OccupantsController::class,'destroy'])->name('Dashboard.deleteOccupant');
    Route::post('/updateOccupant/{id}',[OccupantsController::class,'update'])->name('Dashboard.updateOccupant');
    Route::get('/editOccupant/{id}',[OccupantsController::class,'edit'])->name('Dashboard.editOccupant');
});
// Route::middleware(['auth','role:occupant'])->prefix('Dashboard')->group)(function(){
   
// });



/**Normal user login */
Route::get('/user',[DashboardController::class,'userLogin']);
Route::get('/userRegister',[DashboardController::class,'userRegister']);

