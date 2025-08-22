<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $type = $request->query('type');
        $slug = $request->query('slug');

        if(!$type){
            return response()->json(['error' => 'type is required'], 400);
        }
        $categories = Category::where('type', $type)->get();
        if($categories->isEmpty()){
            return response()->json(['error' => 'category not found of type'], 404);
        }
        if(!$slug){
            return $this->show($categories);
        }
        $category = $categories->where('slug', $slug)->first();
        if($category === Null){
            return response()->json(['error' => 'category not found of slug'], 404);

        }
        return $this->show($category);
        // return response()->json(['message'=>'done']);
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
    public function show($categories)
    {
        return response()->json($categories);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
