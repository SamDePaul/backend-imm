<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicator;

class IndicatorController extends Controller
{
    public function getIndicators()
    {
        // Fetch all tasks from the database
        $indicator = Indicator::all();
        return response()->json($indicator);
    }
}
