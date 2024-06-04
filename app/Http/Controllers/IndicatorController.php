<?php

namespace App\Http\Controllers;

use App\Models\Indicator;
use App\Models\Sdg;
use Illuminate\Http\Request;

class IndicatorController extends Controller
{
    public function index()
    {
        $indicators = Indicator::with('sdg')->get();
        return view('indicators.index', compact('indicators'));
    }

    public function create()
    {
        $sdgs = Sdg::all();
        $indicators = Indicator::all();
        return view('indicators.create', compact('sdgs', 'indicators'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required',
            'level' => 'required',
            'sdg_id' => 'required|exists:sdgs,id',
        ]);

        Indicator::create($request->all());

        return redirect()->route('indicators.index')->with('success', 'Indicator created successfully.');
    }

    public function show(Indicator $indicator)
    {
        return view('indicators.show', compact('indicator'));
    }

    public function edit(Indicator $indicator)
    {
        $sdgs = Sdg::all();
        $indicators = Indicator::all();
        return view('indicators.edit', compact('indicator', 'sdgs', 'indicators'));
    }

    public function update(Request $request, Indicator $indicator)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required',
            'level' => 'required',
            'sdg_id' => 'required|exists:sdgs,id',
        ]);

        $indicator->update($request->all());

        return redirect()->route('indicators.index')->with('success', 'Indicator updated successfully.');
    }

    public function destroy(Indicator $indicator)
    {
        $indicator->delete();

        return redirect()->route('indicators.index')->with('success', 'Indicator deleted successfully.');
    }

    public function getIndicators()
    {
        try {
            $indicators = Indicator::all();
            return response()->json($indicators);
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
