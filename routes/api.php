<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\login;
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

Route::post('login',[login::class,'apilogin']);

Route::middleware("auth:sanctum")->group(function(){
Route::post('user-data',[FormController::class,'add']);
Route::get('view-data',[FormController::class,'search']);
});