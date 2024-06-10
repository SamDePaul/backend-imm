<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Country;
use App\Models\Sdg;
use App\Models\ProjectMatric;
use Illuminate\Support\Facades\Storage;

class ProjectsController extends Controller
{
    // Display a listing of the projects.
    public function index(Request $request)
    {
        $search = $request->input('search');

        $projects = Project::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%")
                    ->orWhere('tanggalMulai', 'like', "%$search%");
            })
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    // Show the form for creating a new project.
    public function create()
    {
        $tags = Tag::all();
        $countries = Country::all();
        $sdgs = Sdg::all();
        return view('projects.create', compact('tags', 'countries', 'sdgs'));
    }

    // Store a newly created project in storage.
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tags' => 'required|string',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
            'targetPelanggan' => 'required|string',
            'tanggalMulai' => 'required|date',
            'tanggalSelesai' => 'required|date|after_or_equal:tanggalMulai',
            'negara' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'data_path' => 'required|file|mimes:jpg,jpeg,png',
            'kategori' => 'required|string',
            'dana' => 'required|numeric',
            'jenis_dana' => 'required|string',
            'dana_lain' => 'required|numeric',
            'sdg' => 'required|string',
            'indikator' => 'required|string',
            'matrik' => 'required|string',
        ]);

        $path = $request->file('data_path')->store('projects', 'public');

        $project = Project::create([
            'user_id' => auth()->id(),
            'tag_id' => $request->tags,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan' => $request->tujuan,
            'targetPelanggan' => $request->targetPelanggan,
            'tanggalMulai' => $request->tanggalMulai,
            'tanggalSelesai' => $request->tanggalSelesai,
            'negara_id' => $request->negara,
            'provinsi_id' => $request->provinsi,
            'kota_id' => $request->kota,
            'data_path' => $path,
            'kategori' => $request->kategori,
            'dana' => $request->dana,
            'jenis_dana' => $request->jenis_dana,
            'dana_lain' => $request->dana_lain,
            'sdg_id' => $request->sdg,
            'indikator_id' => $request->indikator,
            'matrik_id' => $request->matrik,
        ]);

        ProjectMatric::create([
            'matric_id' => $request->matrik,
            'project_id' => $project->id,
            'value' => 0,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Display the specified project.
    public function show($id)
    {
        $project = Project::findOrFail($id);
        return view('projects.show', compact('project'));
    }

    // Show the form for editing the specified project.
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        $tags = Tag::all();
        $countries = Country::all();
        $sdgs = Sdg::all();
        return view('projects.edit', compact('project', 'tags', 'countries', 'sdgs'));
    }

    // Update the specified project in storage.
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'tags' => 'required|string',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
            'targetPelanggan' => 'required|string',
            'tanggalMulai' => 'required|date',
            'tanggalSelesai' => 'required|date|after_or_equal:tanggalMulai',
            'negara' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'data_path' => 'nullable|file|mimes:jpg,jpeg,png',
            'kategori' => 'required|string',
            'dana' => 'required|numeric',
            'jenis_dana' => 'required|string',
            'dana_lain' => 'required|numeric',
            'sdg' => 'required|string',
            'indikator' => 'required|string',
            'matrik' => 'required|string',
        ]);

        if ($request->hasFile('data_path')) {
            if ($project->data_path) {
                Storage::delete('public/' . $project->data_path);
            }

            $path = $request->file('data_path')->store('projects', 'public');
            $project->data_path = $path;
        }

        $project->update([
            'tag_id' => $request->tags,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan' => $request->tujuan,
            'targetPelanggan' => $request->targetPelanggan,
            'tanggalMulai' => $request->tanggalMulai,
            'tanggalSelesai' => $request->tanggalSelesai,
            'negara_id' => $request->negara,
            'provinsi_id' => $request->provinsi,
            'kota_id' => $request->kota,
            'kategori' => $request->kategori,
            'dana' => $request->dana,
            'jenis_dana' => $request->jenis_dana,
            'dana_lain' => $request->dana_lain,
            'sdg_id' => $request->sdg,
            'indikator_id' => $request->indikator,
            'matrik_id' => $request->matrik,
        ]);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Remove the specified project from storage.
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->data_path) {
            Storage::delete('public/' . $project->data_path);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    // Return all projects as JSON.
    public function getAllProjects()
    {
        $projects = Project::all();

        return response()->json($projects);
    }

    // Return a specific project by ID as JSON.
    public function getProject($id)
    {
        $project = Project::findOrFail($id);

        return response()->json($project);
    }

    // Create a new project via API request.
    public function createProject(Request $request)
    {
        \Log::info($request);
        $validatedData = $request->validate([
            'user_id' => 'required',
            'tag_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tujuan' => 'required',
            'targetPelanggan' => 'required',
            'tanggalMulai' => 'required',
            'tanggalSelesai' => 'required',
            'negara_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'data_path' => 'required', // Jika ini adalah path ke file yang diunggah, sesuaikan dengan aturan validasi yang sesuai
            'kategori' => 'required',
            'dana' => 'required',
            'jenis_dana' => 'required',
            'dana_lain' => 'required',
            'sdg_id' => 'required',
            'indikator_id' => 'required',
            'matrik_id' => 'required',
        ]);

        \Log::info('Validated data:', $validatedData);

        try {
            $path = $request->file('data_path')->store('data_files', 'public');
            \Log::info('File stored at path:', ['path' => $path]);

            $project = Project::create([
                'user_id' => $request->user_id,
                'tag_id' => $request->tag_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tujuan' => $request->tujuan,
                'targetPelanggan' => $request->targetPelanggan,
                'tanggalMulai' => $request->tanggalMulai,
                'tanggalSelesai' => $request->tanggalSelesai,
                'negara_id' => $request->negara_id,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'data_path' => $path,
                'kategori' => $request->kategori,
                'dana' => $request->dana,
                'jenis_dana' => $request->jenis_dana,
                'dana_lain' => $request->dana_lain,
                'sdg_id' => $request->sdg_id,
                'indikator_id' => $request->indikator_id,
                'matrik_id' => $request->matrik_id,
            ]);
            ProjectMatric::create([
                'matric_id' => $request->matrik_id,
                'project_id' => $project->id,
                'value' => 0,
            ]);

            return response()->json(['success' => 'Project created successfully.']);

        } catch (\Exception $e) {
            \Log::error('Error creating project:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to create project'], 500);
        }
    }

    // Update an existing project via API request.
    public function updateProject(Request $request, $id)
    {
        \Log::info($request);
        $validatedData = $request->validate([
            'user_id' => 'required',
            'tag_id' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'tujuan' => 'required',
            'targetPelanggan' => 'required',
            'tanggalMulai' => 'required',
            'tanggalSelesai' => 'required',
            'negara_id' => 'required',
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'data_path' => 'sometimes', // Optional file upload
            'kategori' => 'required',
            'dana' => 'required',
            'jenis_dana' => 'required',
            'dana_lain' => 'required',
            'sdg_id' => 'required',
            'indikator_id' => 'required',
            'matrik_id' => 'required',
            'value' => 'required', // Adding validation for value
        ]);

        \Log::info('Validated data:', $validatedData);

        try {
            $project = Project::findOrFail($id);

            // Store the new file if uploaded
            if ($request->hasFile('data_path')) {
                $path = $request->file('data_path')->store('data_files', 'public');
                \Log::info('File stored at path:', ['path' => $path]);
            } else {
                $path = $project->data_path; // Use the existing path if no new file is uploaded
            }

            $project->update([
                'user_id' => $request->user_id,
                'tag_id' => $request->tag_id,
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tujuan' => $request->tujuan,
                'targetPelanggan' => $request->targetPelanggan,
                'tanggalMulai' => $request->tanggalMulai,
                'tanggalSelesai' => $request->tanggalSelesai,
                'negara_id' => $request->negara_id,
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'data_path' => $path,
                'kategori' => $request->kategori,
                'dana' => $request->dana,
                'jenis_dana' => $request->jenis_dana,
                'dana_lain' => $request->dana_lain,
                'sdg_id' => $request->sdg_id,
                'indikator_id' => $request->indikator_id,
                'matrik_id' => $request->matrik_id,
            ]);

            $projectMatric = ProjectMatric::where('project_id', $id)->first();
            if ($projectMatric) {
                $projectMatric->update([
                    'matric_id' => $request->matrik_id,
                    'value' => $request->value, // Update value with input from request
                ]);
            }

            return response()->json(['success' => 'Project updated successfully.']);

        } catch (\Exception $e) {
            \Log::error('Error updating project:', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to update project'], 500);
        }
    }

    // Return a project by its metric ID as JSON.
    public function getProjectByMatricId($matricId)
    {
        $projectMatric = ProjectMatric::with('project')->where('matric_id', $matricId)->first();

        if (!$projectMatric) {
            return response()->json(['error' => 'ProjectMatric not found'], 404);
        }

        return response()->json([
            'project' => $projectMatric->project,
        ]);
    }
}
