<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sdg;

class sdgController extends Controller
{
    public function index(Request $request)
    {
        $sdg2 = sdg::all();
        return view('sdgs.index', compact('sdg2'));
    }

    public function create()
    {
        $sdg2 = new sdg(); // Create a new sdg instance
        return view('sdgs.create', compact('sdg2',));
    }



    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'nik' => 'required|string|max:16',
                'email' => 'required|string|email|max:255|unique:sdgs',
                'password' => 'required|string|min:8|confirmed',
                'no_hp' => 'required|string|max:13',
                'negara' => 'required|string|max:255',
                'provinsi' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
            ]);

            $sdg2 = sdg::create([
                'nama_lengkap' => $request->nama_lengkap,
                'nik' => $request->nik,
                'email' => $request->email,
                'password' => $request->password, // Ensure to encrypt the password before saving
                'no_hp' => $request->no_hp,
                'negara' => $request->negara,
                'provinsi' => $request->provinsi,
                'alamat' => $request->alamat,
                'role' => 'sdgs',
            ]);

            return redirect()->route('sdgs.index')->with('success', 'sdg created successfully.');
        } catch (\Exception $e) {
            dd($e);
            return back()->withInput()->withErrors($e->getMessage());
        }
    }


    public function show($id)
    {
        $sdg2 = sdg::findOrFail($id);
        return view('sdgs.show', compact('sdg2'));
    }

    public function edit($id)
    {
        $sdg2 = sdg::findOrFail($id);
        return view('sdgs.edit', compact('sdg2'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|min:16|max:16',
            'email' => 'required|string|email|max:255|unique:sdgs,email,'.$id,
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|min:10|max:13',
            'negara' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
        ]);

        $sdg2 = sdg::findOrFail($id);
        $sdg2->nama_lengkap = $request->nama_lengkap;
        $sdg2->nik = $request->nik;
        $sdg2->email = $request->email;
        $sdg2->no_hp = $request->no_hp;
        $sdg2->negara = $request->negara;
        $sdg2->provinsi = $request->provinsi;
        $sdg2->alamat = $request->alamat;

         // Check if a new password has been provided
        if ($request->filled('password')) {
            $sdg2->password = $request->password;
        }

        $sdg2->save();

        return redirect()->route('sdgs.index')->with('success', 'sdg updated successfully.');
    }

    public function destroy($id)
    {
        $sdg2 = sdg::findOrFail($id);
        $sdg2->delete();

        return redirect()->route('sdgs.index')->with('success', 'sdg deleted successfully.');
    }


    public function getSdg()
    {
        // Fetch all tasks from the database
        $sdg = sdg::all();
        return response()->json($sdg);
    }
}
