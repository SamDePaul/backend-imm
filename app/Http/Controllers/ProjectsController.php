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

    public function store(Request $request)
    {
        try {
        $request->validate([
            'selectedIdTag' => 'required|string',
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
    } catch (\Exception $e) {
        dd($e);
        return back()->withInput()->withErrors($e->getMessage());
    }
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
            'tags' => 'required',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tujuan' => 'required|string',
            'tanggalMulai' => 'required|date',
            'tanggalSelesai' => 'required|date|after_or_equal:tanggalMulai',
            'negara' => 'required|exists:countries,id',
            'provinsi' => 'required|exists:regions,id',
            'kota' => 'required|exists:cities,id',
            'data_path' => 'nullable|file|mimes:jpg,jpeg,png',
            'kategori' => 'required|string',
            'dana' => 'required|numeric',
            'jenis_dana' => 'required|string',
            'dana_lain' => 'required|numeric',
            'sdg' => 'required|exists:sdgs,id',
            'indikator' => 'required|exists:indicators,id',
            'matrik' => 'required|exists:metrics,id',
        ]);

        $project = Project::findOrFail($id);

        if ($request->hasFile('data_path')) {
            // Delete the old image if it exists
            if ($project->data_path) {
                Storage::delete('public/' . $project->data_path);
            }

            // Store the new image
            $path  = $request->file('data_path')->store('public/data');
            $project->data_path = str_replace('public/', '', $path );
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

        // Delete the image associated with the project
        if ($project->path) {
            Storage::delete('public/' . $project->path);
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
