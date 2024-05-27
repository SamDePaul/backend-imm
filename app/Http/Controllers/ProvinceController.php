<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City; // Pastikan model City sesuai dengan tabel Anda
use App\Models\State;

class ProvinceController extends Controller
{
    public function getRegions($country_id)
    {   
        \Log::info("Received country_id: $country_id");
        try {
            $states = State::where('country_id', $country_id)->get();
            return response()->json($states);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getCities($region_id)
    {
        \Log::info("Received state_id: $region_id");
        try {
            $cities = City::where('state_id', $region_id)->get();
            return response()->json($cities);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}



