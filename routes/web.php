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
Route::get('/', function () {
    return view('welcome');
});
// Receive the AJAX form submission
Route::post('user-data', [FormController::class, 'add']);
// Display the form and existing user records
Route::get('user-data', [FormController::class, 'index']);
// Handle unknown URLs
Route::fallback(function() {
    return "<h1>PAGE NOT FOUND</h1>";
});