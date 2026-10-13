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

Route::middleware('isuservalid','inactivelogout','preventbackbutton')->group(function(){
// Receive the AJAX form submission
Route::post('user-data', [FormController::class, 'add']);
// shows countries in dropdown using laravel and cache storage
Route::get('countries',[FormController::class,'countries']);
// Display the form/user-data blade
Route::get('user-data', function(){return view('user-data');});
});