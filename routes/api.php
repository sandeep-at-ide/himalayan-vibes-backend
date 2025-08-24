<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

use App\Models\User;
use App\Http\Controllers\{
    PackageController,
    FaqController,
    BlogController,
    PageController,
    DestinationController,
    CategoryController,
    ReviewController,
    BookingsController,
    SiteController,
    CustomTripQueryController,
    ContactMessageController,
};

// Login route
Route::post('/login', function (Request $request) {
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

// Authenticated API routes
Route::middleware('auth:sanctum')->group(function () {

    // ✅ Full API resources (CRUD)
    Route::apiResource('/bookings', BookingsController::class);
    Route::apiResource('/reviews', ReviewController::class);
    Route::apiResource('/customtrip', CustomTripQueryController::class);
    Route::apiResource('/contactmessage', ContactMessageController::class);
    // ✅ Example test route (optional)
    // Route::get('/test', function () {
    //     return response()->json(['message'=> 'Test passed']);
    // });
});

// ✅ Read-only GET routes
Route::get('/packages', [PackageController::class, 'index']);
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/pages', [PageController::class, 'index']);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/site', [SiteController::class, 'index']);
