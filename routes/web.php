<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| These routes handle displaying and submitting the user form.
*/

// Display the user data page
Route::get('/',function(){return view("dashboard");});
// Receive the AJAX form submission
Route::post('user-data', [FormController::class, 'add']);
// Display the form
Route::get('user-data', [FormController::class, 'index']);
// dashboard
Route::get('view-data',[FormController::class,'show']);
// Handle unknown URLs
Route::fallback(function() {
    return "<h1>PAGE NOT FOUND</h1>";
});