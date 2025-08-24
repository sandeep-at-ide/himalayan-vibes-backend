<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    // GET /api/destinations
    public function index(Request $request)
    {
        $category_slug = $request->query('category_slug');

        if ($category_slug) {
            $category = Category::where('slug', $category_slug)->first();
            if (!$category) {
                return (new ErrorController)->notFound("Category not found");
            }

            $destinations = Destination::where('category_id', $category->id)->get();
            if ($destinations->isEmpty()) {
                return (new ErrorController)->notFound("No destinations found for this category");
            }

            return response()->json($destinations, 200);
        }

        return response()->json(Destination::all(), 200);
    }

    // POST /api/destinations
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'name' => 'required|string',
        //     'slug' => 'required|string|unique:destinations,slug',
        //     'description' => 'nullable|string',
        //     'category_id' => 'required|exists:categories,id',
        // ]);

        // $destination = Destination::create($validated);

        // return response()->json($destination, 201);
    }

    // GET /api/destinations/{id}
    public function show($id)
    {
        $destination = Destination::where('slug', $id)->first();
        if (!$destination) {
            return (new ErrorController)->notFound();
        }

        return response()->json($destination, 200);
    }

    // PUT /api/destinations/{id}
    public function update(Request $request, $id)
    {
        // 
    }

    // DELETE /api/destinations/{id}
    public function destroy($id)
    {
        //
    }
}
