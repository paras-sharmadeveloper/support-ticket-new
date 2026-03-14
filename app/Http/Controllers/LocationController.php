<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {

        $location = Location::create([

            'name' => $request->name,
            'company_id' => auth()->user()->company_id

        ]);

        return response()->json($location);
    }
}
