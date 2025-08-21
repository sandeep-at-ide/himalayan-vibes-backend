<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $package_id = $request->query('package_id');
        if(!$package_id){
            return response()->json(['error' => 'package_id is required'], 400);
        }
        $reviews = Review::where('package_id', $package_id)->first();
        if(!$reviews){
            return response()->json(['error' => 'reviews not found'], 404);
        }
        return response()->json($reviews);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
