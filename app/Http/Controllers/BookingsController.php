<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource or a specific booking.
     */
    public function index(Request $request)
    {
        $user_id = $request->query('user_id');
        $booking_id = $request->query('booking_id');

        if (!$user_id) {
            return response()->json(['error' => 'user_id is required'], 400);
        }

        // Fetch all bookings for the user
        $bookings = Booking::where('User_id', $user_id)->get();

        if ($booking_id) {
            // Find a specific booking from the list
            $booking = $bookings->where('id', $booking_id)->first();

            if (!$booking) {
                return response()->json(['error' => 'Booking not found for this user'], 404);
            }

            return response()->json($booking);
        }

        if ($bookings->isEmpty()) {
            return response()->json(['error' => 'No bookings found for this user'], 404);
        }

        return response()->json($bookings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // To be implemented
    }

    /**
     * Display the specified resource.
     */
    public function show($booking)
    {
        return response()->json($booking);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // To be implemented
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // To be implemented
    }
}
