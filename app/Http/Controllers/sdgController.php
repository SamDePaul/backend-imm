<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Indicator;
use App\Models\MetricTag;
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
        \Log::info("Received sdgs_id: $sdgs_id");
        try {
            $indicators = Indicator::where('sdg_id', $sdgs_id)->get();
            return response()->json($indicators);
        } catch (\Exception $e) {
            \Log::error("Error retrieving indicators: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getMatriks($tag_id)
    {
        \Log::info("Received tag_id: $tag_id");
        try {
            $matrikTags = MetricTag::where('tag_id', $tag_id)->get();
            \Log::info("Received matriktag: $matrikTags");
            if ($matrikTags) {
                $matriks = [];
                foreach ($matrikTags as $matrikTag) {
                    $metric_id = $matrikTag->metric_id;
                    \Log::info("Processing MatrikTag with metric_id: $metric_id");

                    $matrik = Metric::find($metric_id);
                    if ($matrik) {
                        $matriks[] = $matrik; // Add the retrieved Metric to the array

                    } else {
                        \Log::info("Metric not found for metric_id: $metric_id");
                    }
                }
                return response()->json($matriks);

            } else {
                // Handle the case where no tag is found
            }
        } catch (\Exception $e) {
            \Log::error("Error retrieving matriks: " . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
