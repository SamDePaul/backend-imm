<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdg;

class sdgController extends Controller
{
    public function getSdg()
    {
        // Fetch all tasks from the database
        $sdg = sdg::all();
        return response()->json($sdg);
    }
}
