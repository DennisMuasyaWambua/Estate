<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
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

Route::get('/dashboard', [DashboardController::class,'dashboard']);


Route::middleware('auth')->group(function(){
    Route::get('/home',[DashboardController::class,'index']);
});
/** care taker routes */
//route to register the caretaker
Route::get('/caretaker',[DashboardController::class,'loginCareTaker']);

//route to login the caretaker
Route::get('/caretakerRegister', [DashboardController::class,'registerCaretaker']);

