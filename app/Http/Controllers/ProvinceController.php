<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City; // Pastikan model City sesuai dengan tabel Anda
use App\Models\State;
use App\Models\Country;

class ProvinceController extends Controller
{
    public function getCountries()
    {
        try {
            $Countries = Country::all();
            return response()->json($Countries);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

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

    public function getCountryById($id)
    {
        \Log::info("Received country_id: $id");
        try {
            $country = Country::where('id', $id)->get();
            return response()->json($country);
        } catch (\Exception $e) {
            \Log::error("Error retrieving country: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getRegionById($region_id)
    {
        \Log::info("Received region_id: $region_id");
        try {
            $states = State::where('id', $region_id)->get();
            return response()->json($states);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getCityById($city_id)
    {
        \Log::info("Received city_id: $city_id");
        try {
            $cities = City::where('id', $city_id)->get();
            return response()->json($cities);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}



