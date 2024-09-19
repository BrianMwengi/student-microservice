<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth.api')->group(function () {
    Route::get('students', [StudentController::class, 'index']);
    // Other protected routes here
});