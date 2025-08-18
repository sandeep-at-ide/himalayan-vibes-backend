<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/api/packages', [PackageController::class, 'index']);


Route::get('/api/faqs', [FaqController::class, 'index']);

Route::get('/api/blogs', [BlogController::class, 'index']);
