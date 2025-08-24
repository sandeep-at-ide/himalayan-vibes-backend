<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blog = (Blog::all());
        $slug = $request->query('slug');
        if($slug){
            $blog = $blog->where('slug', $slug)->first();
            if(!$blog){
                return (new ErrorController)->notFound();
            }
        }
        return response()->json($blog);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return response()->json(Blog::find($slug));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
