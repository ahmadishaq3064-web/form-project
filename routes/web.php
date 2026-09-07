<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
use App\Http\Controllers\login;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes handle displaying and submitting the user form.
*/

// registration page
Route::get('registration', function(){return view('registration');});
Route::post('registration',[login::class,'registration']);
// login page
Route::get('/', function(){return view('login');});
Route::post('/',[login::class,'login']);
// logout
Route::get('logout',[login::class,'logout']);
// Display the user data page
Route::get('dashboard', [FormController::class, 'averageage']);
// Receive the AJAX form submission
Route::post('user-data', [FormController::class, 'add']);
// Display the form
Route::get('user-data', [FormController::class, 'index']);
// search and show data
Route::get('view-data',[FormController::class,'search']);
// Handle unknown URLs
Route::fallback(function() {
    return "<h1>PAGE NOT FOUND</h1>";
});