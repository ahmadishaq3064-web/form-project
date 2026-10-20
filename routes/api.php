<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

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



Route::middleware("client")->group(function(){
Route::get('view-data',[FormController::class,'dataforapi']);
Route::post('addition',[FormController::class,'addition']);
});