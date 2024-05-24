<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bootcamp;

class bootcampsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $bootcamps = Bootcamp::query()
            ->when($search, function ($query) use ($search) {
                return $query->where('judul', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%")
                    ->orWhere('tanggal', 'like', "%$search%");
            })
            ->paginate(10);

        return view('bootcamps.index', compact('bootcamps'));

    }

    public function create()
    {
        return view('bootcamps.create');
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

        Bootcamp::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'poster_path' => str_replace('public/', '', $posterPath),
            'harga' => $request->harga,
        ]);

        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp created successfully.');
    }

    public function show($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('bootcamps.show', compact('bootcamp'));
    }

    public function edit($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);
        return view('bootcamps.edit', compact('bootcamp'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date',
            'pembicara' => 'required|string|max:255',
            'poster_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|string|max:255',
        ]);

        $bootcamp = Bootcamp::findOrFail($id);

        if ($request->hasFile('poster_path')) {
            // Delete the old image if it exists
            if ($bootcamp->poster_path) {
                Storage::delete('public/' . $bootcamp->poster_path);
            }

            // Store the new image
            $posterPath = $request->file('poster_path')->store('public/posters');
            $bootcamp->poster_path = str_replace('public/', '', $posterPath);
        }

        $bootcamp->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'harga' => $request->harga,
        ]);

        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp updated successfully.');
    }


    public function destroy($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        // Delete the image associated with the bootcamp
        if ($bootcamp->poster_path) {
            Storage::delete('public/' . $bootcamp->poster_path);
        }

        // Delete the bootcamp from the database
        $bootcamp->delete();

        return redirect()->route('bootcamps.index')->with('success', 'Bootcamp deleted successfully.');
    }

    public function getAllBootcamps()
    {
        $bootcamps = Bootcamp::all();

        return response()->json([
            'bootcamps' => $bootcamps,
        ]);
    }

    public function getBootcamp($id)
    {
        $bootcamp = Bootcamp::findOrFail($id);

        return response()->json([
            'bootcamp' => $bootcamp,
        ]);
    }
}
