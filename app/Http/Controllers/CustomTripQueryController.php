<?php

namespace App\Http\Controllers;

use App\Models\CustomTripQuery;
use Illuminate\Http\Request;

class CustomTripQueryController extends Controller
{
    /**
     * Display a listing of the authenticated user's custom trip queries.
     */
    public function index(Request $request)
    {
        $user_id = auth()->id();

        $queries = CustomTripQuery::where('user_id', $user_id)->get();

        if ($queries->isEmpty()) {
            return response()->json(['message' => 'No custom trip queries found'], 404);
        }

        return response()->json($queries);
    }

    /**
     * Store a newly created custom trip query.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'               => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'preferred_location' => 'nullable|string|max:255',
            'travel_dates'       => 'nullable|string|max:255',
            'number_of_people'   => 'nullable|integer|min:1',
            'budget'             => 'nullable|numeric|min:0',
            'message'            => 'nullable|string',
            'status'             => 'sometimes|in:pending,reviewed,approved,rejected,replied',
        ]);

        // Assign user_id if authenticated, else null (as per schema)
        $validated['user_id'] = auth()->id();

        $query = CustomTripQuery::create($validated);

        return response()->json([
            'message' => 'Custom trip query created successfully',
            'data' => $query,
        ], 201);
    }

    /**
     * Display the specified custom trip query.
     */
    public function show($id)
    {
        $user_id = auth()->id();

        $query = CustomTripQuery::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $query) {
            return response()->json(['message' => 'Custom trip query not found'], 404);
        }

        return response()->json($query);
    }

    /**
     * Update the specified custom trip query.
     */
    public function update(Request $request, $id)
    {
        $user_id = auth()->id();

        $query = CustomTripQuery::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $query) {
            return response()->json(['message' => 'Custom trip query not found'], 404);
        }

        $validated = $request->validate([
            'name'               => 'nullable|string|max:255',
            'email'              => 'nullable|email|max:255',
            'phone'              => 'nullable|string|max:50',
            'preferred_location' => 'nullable|string|max:255',
            'travel_dates'       => 'nullable|string|max:255',
            'number_of_people'   => 'nullable|integer|min:1',
            'budget'             => 'nullable|numeric|min:0',
            'message'            => 'nullable|string',
            'status'             => 'sometimes|in:pending,reviewed,approved,rejected,replied',
        ]);

        $query->update($validated);

        return response()->json([
            'message' => 'Custom trip query updated successfully',
            'data' => $query,
        ]);
    }

    /**
     * Remove the specified custom trip query.
     */
    public function destroy($id)
    {
        $user_id = auth()->id();

        $query = CustomTripQuery::where('id', $id)
            ->where('user_id', $user_id)
            ->first();

        if (! $query) {
            return response()->json(['message' => 'Custom trip query not found'], 404);
        }

        $query->delete();

        return response()->json([
            'message' => 'Custom trip query deleted successfully',
        ]);
    }
}
