<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/getStudents', [App\Http\Controllers\HomeController::class, 'students'])->name('students');
Route::get('/delete/{id}', [App\Http\Controllers\HomeController::class, 'delete']);
Route::post('/saveStudents', [App\Http\Controllers\HomeController::class, 'saveStudent']);