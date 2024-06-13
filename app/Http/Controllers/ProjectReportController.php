<?php

namespace App\Http\Controllers;

use App\Models\ProjectReport;
use App\Models\Project;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProjectReportController extends Controller
{
    public function index()
    {
        $projectReports = ProjectReport::all();
        return view('project_reports.index', compact('projectReports'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('project_reports.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'report_date' => 'required|date',
            'impact_measure' => 'nullable|string',
            'progress_percentage' => 'required|numeric',
        ]);

        ProjectReport::create($request->all());

        return redirect()->route('project_reports.index')->with('success', 'Laporan berhasil disimpan');
    }

    public function show($id)
    {
        $projectReport = ProjectReport::findOrFail($id);
        $projectId = $projectReport->project_id;
    
        $reports = ProjectReport::where('project_id', $projectId)->orderBy('report_date')->get();
        $dates = $reports->pluck('report_date')->map(function ($date) {
            return \Carbon\Carbon::parse($date)->format('Y-m-d');
        });
        $progress = $reports->pluck('progress_percentage');
    
        return view('project_reports.show', compact('projectReport', 'dates', 'progress'));
    }
    
    
    

    public function edit($id)
    {
        $projectReport = ProjectReport::findOrFail($id);
        $projects = Project::all();
        return view('project_reports.edit', compact('projectReport', 'projects'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'report_date' => 'required|date',
            'impact_measure' => 'nullable|string',
            'progress_percentage' => 'required|numeric',
        ]);

        $projectReport = ProjectReport::findOrFail($id);
        $projectReport->update($request->all());

        return redirect()->route('project_reports.index')->with('success', 'Laporan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $projectReport = ProjectReport::findOrFail($id);
        $projectReport->delete();

        return redirect()->route('project_reports.index')->with('success', 'Laporan berhasil dihapus');
    }
}
