<?php

namespace App\Http\Controllers;

// use App\Models\api\packages\;
use Illuminate\Http\Request;
use App\Models\Package;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $slug = $request->query('slug');
        if($slug){
            // echo $slug;
            return $this->show($slug);
        }
        return response()->json(Package::all());;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show($slug)
    {
        $package = Package::where('slug', $slug)->first();
        if (!$package) {
            return response()->json(['error' => 'Package not found.'], 404);
        }
        return response()->json($package);
    }

    /**
     * Display the specified resource.
     */
    public function store(Request $request)
    {
     //   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, packages $packages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(packages $packages)
    {
        //
    }
}
