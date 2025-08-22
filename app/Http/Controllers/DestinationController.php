<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Category;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $slug = $request->query('slug');
        $category_slug = $request->query('categoryslug');

        // If a specific destination slug is provided
        if ($slug) {
            $destination = Destination::where('slug', $slug)->first();
            if (!$destination) {
                return (new ErrorController)->notFound();
            }
            return $this->show($destination);
        }

        // If a category slug is provided
        if ($category_slug) {
            $category = Category::where('slug', $category_slug)->first();
            if (!$category) {
                return (new ErrorController)->notFound();
            }

            $destinations = Destination::where('category_id', $category->id)->get();
            if ($destinations->isEmpty()) {
                return (new ErrorController)->notFound();
            }

            return $this->show($destinations);
        }

        // Default: return all destinations
        $destinations = Destination::all();
        return $this->show($destinations);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($destination)
    {
        return response()->json($destination);
    }

    public function update(Request $request, Destination $destination)
    {
        //
    }

    public function destroy(Destination $destination)
    {
        //
    }
}
