<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Indicator;
use App\Models\MetricTag;
use App\Models\MetricIndicator;
use App\Models\Metric;
use Illuminate\Http\Request;

class SdgController extends Controller
{
    public function index()
    {
        $sdgs = Sdg::all();
        return view('sdgs.index', compact('sdgs'));
    }

    public function create()
    {
        return view('sdgs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Sdg::create($request->all());

        return redirect()->route('sdgs.index')->with('success', 'SDG created successfully.');
    }

    public function show(Sdg $sdg)
    {
        return view('sdgs.show', compact('sdg'));
    }

    public function edit(Sdg $sdg)
    {
        return view('sdgs.edit', compact('sdg'));
    }

    public function update(Request $request, Sdg $sdg)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $sdg->update($request->all());

        return redirect()->route('sdgs.index')->with('success', 'SDG updated successfully.');
    }

    public function destroy(Sdg $sdg)
    {
        $sdg->delete();

        return redirect()->route('sdgs.index')->with('success', 'SDG deleted successfully.');
    }

    public function getIndicators($sdgs_id)
    {
        try {
            $indicators = Indicator::where('sdg_id', $sdgs_id)->get();
            return response()->json($indicators);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getMatriks($tag_id)
    {
        try {
            $matrikTags = MetricTag::where('tag_id', $tag_id)->get();

            if ($matrikTags) {
                $matriks = [];
                foreach ($matrikTags as $matrikTag) {
                    $metric_id = $matrikTag->metric_id;

                    $matrik = Metric::find($metric_id);
                    if ($matrik) {
                        $matriks[] = $matrik; // Add the retrieved Metric to the array

                    } else {
                    }
                }
                return response()->json($matriks);
            } else {
                // Handle the case where no tag is found
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getMatriksByIndicator($indicator_id)
    {
        try {
            $matrikIndicators = MetricIndicator::where('indicator_id', $indicator_id)->get();

            if ($matrikIndicators) {
                $matriks = [];
                foreach ($matrikIndicators as $matrikIndicator) {
                    $metric_id = $matrikIndicator->metric_id;

                    $matrik = Metric::find($metric_id);
                    if ($matrik) {
                        $matriks[] = $matrik; // Add the retrieved Metric to the array

                    } else {
                    }
                }
                return response()->json($matriks);
            } else {
                // Handle the case where no tag is found
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getSdg()
    {
        try {
            $sdgs = sdg::all();
            return response()->json($sdgs);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getIndicatorsByIdSdg($sdgs_id)
    {
        \Log::info("Received sdgs_id: $sdgs_id");
        try {
            $indicators = Indicator::where('sdg_id', $sdgs_id)->get();
            return response()->json($indicators);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getMatricsByIdIndicator($indicator_id)
    {
        \Log::info("Received indicator_id: $indicator_id");
        try {
            $matrikIndicators = MetricIndicator::where('indicator_id', $indicator_id)->get();

            if ($matrikIndicators) {
                $matriks = [];
                foreach ($matrikIndicators as $matrikIndicator) {
                    $metric_id = $matrikIndicator->metric_id;

                    $matrik = Metric::find($metric_id);
                    if ($matrik) {
                        $matriks[] = $matrik; // Add the retrieved Metric to the array

                    } else {
                    }
                }
            }
            return response()->json($matriks);
        } catch (\Exception $e) {
            \Log::error("Error retrieving provinces: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
