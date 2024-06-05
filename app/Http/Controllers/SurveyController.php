<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('user_id', Auth::id())->get();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required',
            'survey_title' => 'required',
        ]);

        Survey::create([
            'user_id' => Auth::id(),
            'business_name' => $request->business_name,
            'survey_title' => $request->survey_title,
            'survey_description' => $request->survey_description,
        ]);

        return redirect()->route('surveys.index')->with('success', 'Survey created successfully.');
    }

    public function show(Survey $survey)
    {
        $this->authorize('view', $survey);
        return view('surveys.show', compact('survey'));
    }

    public function edit(Survey $survey)
    {
        $this->authorize('update', $survey);
        return view('surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $this->authorize('update', $survey);
        $request->validate([
            'business_name' => 'required',
            'survey_title' => 'required',
        ]);

        $survey->update($request->all());
        return redirect()->route('surveys.index')->with('success', 'Survey updated successfully.');
    }

    public function destroy(Survey $survey)
    {
        $this->authorize('delete', $survey);
        $survey->delete();
        return redirect()->route('surveys.index')->with('success', 'Survey deleted successfully.');
    }
}
