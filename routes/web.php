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
Route::get('/', [FormController::class, 'averageage']);
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