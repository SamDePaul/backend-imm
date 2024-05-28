<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
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
}
