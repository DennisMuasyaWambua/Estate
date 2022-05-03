<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\payments\mpesa\MpesaController;
use App\Http\Controllers\payments\mpesa\MpesaResponsesController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/validation',[MpesaResponsesController::class,'validation']);
Route::post('/confirmation',[MpesaResponsesController::class,'confirmation']);
Route::post('/stkPush',[MpesaResponsesController::class,'stkPush']);
Route::post('/token',[ApiController::class,'authenticate']);
Route::post('/register',[MpesaResponsesController::class,'registerUser']);
Route::group(['middleware' => ['jwt.verify']], function(){
    Route::get('/getUser',[ApiController::class,'get_user']);
});
Route::get('/getCookie',[MpesaResponsesController::class,'getCookie']);