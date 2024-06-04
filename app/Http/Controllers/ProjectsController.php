<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Country;
use App\Models\Sdg;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;

class ProjectsController extends Controller
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
        $tags = Tag::all();
        $countries = Country::all();
        $sdgs = Sdg::all();
        return view('projects.create', compact('tags', 'countries', 'sdgs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tags' => 'required|string',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
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
            'user_id' => auth()->id(), // Mengisikan user ID secara otomatis
            'tag_id' => $request->tags,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan' => $request->tujuan,
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
        $tags = Tag::all();
        $countries = Country::all();
        $sdgs = Sdg::all();
        return view('projects.edit', compact('project', 'tags', 'countries', 'sdgs'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'tags' => 'required|string',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
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

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->data_path) {
            Storage::delete('public/' . $project->data_path);
        }

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

    public function createProject(Request $request)
    {
        \Log::info($request);
        $request->validate([
            'tags' => 'required|numeric',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
            'tanggalMulai' => 'required',
            'tanggalSelesai' => 'required',
            'negara' => 'required|numeric',
            'provinsi' => 'required|numeric',
            'kota' => 'required|numeric',
            'data_path' => 'required|string',
            'kategori' => 'required|string',
            'dana' => 'required|numeric',
            'jenis_dana' => 'required|string',
            'dana_lain' => 'required|numeric',
            'sdg' => 'required|numeric',
            'indikator' => 'required|numeric',
            'matrik' => 'required|numeric',
        ]);

        $path = $request->file('data_path');

        $project = Project::create([
            'user_id' => auth()->id(), // Mengisikan user ID secara otomatis
            'tag_id' => $request->tags,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tujuan' => $request->tujuan,
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
            'data_path' => $path,
        ]);

        return response()->json([
            'project' => $project,
        ]);
    }
}

