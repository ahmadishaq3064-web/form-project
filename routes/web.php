<?php
use App\Http\Controllers\FormController;
use App\Http\Controllers\login;
use Illuminate\Support\Facades\Route;
/*

|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes handle displaying and submitting the user form.
*/


Route::middleware('guest')->group(function(){
// registration page
Route::get('registration', function(){return view('registration');});
Route::post('registration',[login::class,'registration']);
// login page
Route::get('/', function(){return view('login');});
Route::post('/',[login::class,'login']);

});


Route::middleware('isuservalid')->group(function(){

// Display the user data page
Route::get('dashboard', [FormController::class, 'averageage']);
// Receive the AJAX form submission
Route::post('user-data', [FormController::class, 'add']);
// shows countries in dropdown using laravel and cache storage
Route::get('countries',[FormController::class,'countries']);
// Display the form/user-data blade
Route::get('user-data', function(){return view('user-data');});
// search and show data
Route::get('view-data',[FormController::class,'search']);
// logout
Route::post('logout',[login::class,'logout']);
});


// Handle unknown URLs
Route::fallback(function() {
    return "<h1>PAGE NOT FOUND</h1>";
});