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
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'pertanyaan_1' => 'required',
            'pertanyaan_2' => 'required',
            'pertanyaan_3' => 'required',
            'pertanyaan_4' => 'required',
            'pertanyaan_5' => 'required',
        ]);

        Survey::create([
            'user_id' => Auth::id(),
            'business_name' => $request->business_name,
            'survey_title' => $request->survey_title,
            'survey_description' => $request->survey_description,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'pertanyaan_1' => $request->pertanyaan_1,
            'pertanyaan_2' => $request->pertanyaan_2,
            'pertanyaan_3' => $request->pertanyaan_3,
            'pertanyaan_4' => $request->pertanyaan_4,
            'pertanyaan_5' => $request->pertanyaan_5,
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
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'no_hp' => 'required',
            'pertanyaan_1' => 'required',
            'pertanyaan_2' => 'required',
            'pertanyaan_3' => 'required',
            'pertanyaan_4' => 'required',
            'pertanyaan_5' => 'required',
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
