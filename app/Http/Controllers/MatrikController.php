<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metric;

class MatrikController extends Controller
{
    public function index()
    {
        $metrics = Metric::all();
        return view('metrics.index', compact('metrics'));
    }

    public function create()
    {
        return view('metrics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:metrics',
            'name' => 'required',
        ]);

        Metric::create($request->all());

        return redirect()->route('metrics.index')->with('success', 'Metric created successfully.');
    }

    public function show(Metric $tag)
    {
        return view('metrics.show', compact('tag'));
    }

    public function edit(Metric $tag)
    {
        return view('metrics.edit', compact('tag'));
    }

    public function update(Request $request, Metric $tag)
    {
        $request->validate([
            'slug' => 'required|unique:metrics,slug,'.$tag->id,
            'name' => 'required',
        ]);

        $tag->update($request->all());

        return redirect()->route('metrics.index')->with('success', 'Metric updated successfully.');
    }

    public function destroy(Metric $tag)
    {
        $tag->delete();

        return redirect()->route('metrics.index')->with('success', 'Metric deleted successfully.');
    }

    public function getMatrik()
    {
        // Fetch all tasks from the database
        $matrik = Metric::all();
        return response()->json($matrik);
    }
}
