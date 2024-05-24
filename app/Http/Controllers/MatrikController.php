<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matrik;

class MatrikController extends Controller
{
    public function getMatrik()
    {
        // Fetch all tasks from the database
        $matrik = Matrik::all();
        return response()->json($matrik);
    }
}
