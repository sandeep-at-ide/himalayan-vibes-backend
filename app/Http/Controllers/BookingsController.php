<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    /**
     * Display a list of bookings or a specific booking for the authenticated user.
     */
    public function index(Request $request)
    {
        $user_id = auth()->id();
        $booking_id = $request->query('booking_id');

        if ($booking_id) {
            $booking = Booking::where('id', $booking_id)
                ->where('user_id', $user_id)
                ->first();

            if (! $booking) {
                return (new ErrorController)->notFound('Booking not found for this user');
            }

            return response()->json($booking);
        }

        $bookings = Booking::where('user_id', $user_id)->get();

        if ($bookings->isEmpty()) {
            return (new ErrorController)->notFound('No bookings found for this user');
        }

        return response()->json($bookings);
    }

    /**
     * Store a new booking for the authenticated user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id'        => 'required|exists:packages,id',
            'booking_date'      => 'nullable|date',
            'number_of_people'  => 'nullable|integer|min:1',
            'package_price'     => 'nullable|numeric|min:0',
            'vat_amount'        => 'nullable|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0',
            'total_price'       => 'nullable|numeric|min:0',
            'status'            => 'required|in:pending,reviewed,approved,rejected,replied',
        ]);

        $validated['user_id'] = auth()->id();

        $booking = Booking::create($validated);

        return response()->json([
            'message' => 'Booking created successfully',
            'data' => $booking,
        ], 201);
    }

    /**
     * Display a specific booking for the authenticated user.
     */
    public function show(string $id)
    {
        $user_id = auth()->id();

        $booking = Booking::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $booking) {
            return (new ErrorController)->notFound('Booking not found');
        }

        return response()->json($booking);
    }

    /**
     * Update a booking for the authenticated user.
     */
    public function update(Request $request, string $id)
    {
        $user_id = auth()->id();

        $booking = Booking::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $booking) {
            return (new ErrorController)->notFound('Booking not found');
        }

        // For partial updates, make package_id nullable here
        $validated = $request->validate([
            'package_id'        => 'sometimes|exists:packages,id',
            'booking_date'      => 'nullable|date',
            'number_of_people'  => 'nullable|integer|min:1',
            'package_price'     => 'nullable|numeric|min:0',
            'vat_amount'        => 'nullable|numeric|min:0',
            'discount'          => 'nullable|numeric|min:0',
            'total_price'       => 'nullable|numeric|min:0',
            'status'            => 'required|in:pending,reviewed,approved,rejected,replied',
        ]);

        $booking->update($validated);

        return response()->json([
            'message' => 'Booking updated successfully',
            'data' => $booking,
        ]);
    }

    /**
     * Delete a booking for the authenticated user.
     */
    public function destroy(string $id)
    {
        $user_id = auth()->id();

        $booking = Booking::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $booking) {
            return (new ErrorController)->notFound('Booking not found');
        }

        $booking->delete();

        return response()->json([
            'message' => 'Booking deleted successfully',
        ]);
    }
}
