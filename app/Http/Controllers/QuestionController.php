<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Survey $survey)
    {
        $this->authorize('update', $survey);
        return view('questions.create', compact('survey'));
    }

    public function store(Request $request, Survey $survey)
    {
        $this->authorize('update', $survey);
        $request->validate([
            'question_text' => 'required',
        ]);

        $survey->questions()->create($request->all());
        return redirect()->route('surveys.show', $survey);
    }

    public function edit(Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);
        return view('questions.edit', compact('survey', 'question'));
    }

    public function update(Request $request, Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);
        $request->validate([
            'question_text' => 'required',
        ]);

        $question->update($request->all());
        return redirect()->route('surveys.show', $survey);
    }

    public function destroy(Survey $survey, Question $question)
    {
        $this->authorize('update', $survey);
        $question->delete();
        return redirect()->route('surveys.show', $survey);
    }
}
