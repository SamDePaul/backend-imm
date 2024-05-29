<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Country;
use App\Models\sdg;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class projectsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $projects = Project::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%")
                    ->orWhere('tanggal', 'like', "%$search%");
            })
            ->paginate(10);

        return view('projects.index', compact('projects'));

    }

    public function create()
    {
        $project = new Project;
        $tags = Tag::all();
        $countries = Country::all();
        $sdgs = sdg::all();
        return view('projects.create', compact('project', 'tags', 'countries', 'sdgs'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'poster_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|string|max:255',
        ]);

        $posterPath = $request->file('poster_path')->store('public/posters');

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'poster_path' => str_replace('public/', '', $posterPath),
            'harga' => $request->harga,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|string|max:255',
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('poster_path')) {
            // Delete the old image if it exists
            if ($project->poster_path) {
                Storage::delete('public/' . $project->poster_path);
            }

            // Store the new image
            $posterPath = $request->file('poster_path')->store('public/posters');
            $project->poster_path = str_replace('public/', '', $posterPath);
        }

        $project->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'harga' => $request->harga,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }


    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete the image associated with the project
        if ($project->poster_path) {
            Storage::delete('public/' . $project->poster_path);
        }

        // Delete the project from the database
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    public function getAllProjects()
    {
        $projects = Project::all();

        return response()->json([
            'projects' => $projects,
        ]);
    }

    public function getProject($id)
    {
        $project = Project::findOrFail($id);

        return response()->json([
            'project' => $project,
        ]);
    }
}
