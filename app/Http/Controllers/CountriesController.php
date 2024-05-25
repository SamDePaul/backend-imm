<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    public function create()
    {
        return view('users.create');
    }
    
    public function getAllEvents()
    {
        $Countries = Country::all();

        return response()->json([
            'Countries' => $Countries,
        ]);
    }
}
