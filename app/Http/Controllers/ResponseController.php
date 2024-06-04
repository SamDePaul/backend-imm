<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\Survey;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ]);

        $survey->responses()->create($request->all());
        return redirect()->route('surveys.show', $survey);
    }
}
