<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\SiteController;

use Illuminate\Validation\ValidationException;

Route::post('/login', function (Request $request) 
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The credentials are incorrect.'],
        ]);
    }

    return response()->json([
        'token' => $user->createToken('api-token')->plainTextToken
    ]);
});


//get Apis for Read Operations
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/packages', [PackageController::class, 'index']);
    Route::get('/faqs', [FaqController::class, 'index']);
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/destinations', [DestinationController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/reviews', [ReviewController::class, 'index']);
    Route::get('/bookings', [BookingsController::class, 'index']);
    Route::get('/site', [SiteController::class, 'index']);
    


    //  Route::get('/test', function () {
    //     return response()->json(['message'=> 'message ho nee']);
    // });   
});

