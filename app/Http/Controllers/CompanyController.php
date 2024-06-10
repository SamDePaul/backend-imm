<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function getCompany()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_pic' => 'required',
            'posisi_pic' => 'required',
            'nomor_telepon' => 'required',
            'country' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'jumlah_karyawan' => 'required|integer',
            'tipe_perusahaan' => 'required',
        ]);

        Company::create([
            'user_id' => Auth::id(), // Mengisi user_id dengan ID pengguna yang sedang login
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pic' => $request->nama_pic,
            'posisi_pic' => $request->posisi_pic,
            'nomor_telepon' => $request->nomor_telepon,
            'country' => $request->country,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'jumlah_karyawan' => $request->jumlah_karyawan,
            'tipe_perusahaan' => $request->tipe_perusahaan,
        ]);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_pic' => 'required',
            'posisi_pic' => 'required',
            'nomor_telepon' => 'required',
            'country' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'jumlah_karyawan' => 'required|integer',
            'tipe_perusahaan' => 'required',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }

    public function createCompany(Request $request)
    {
        $request->validate([
            'nama_perusahaan' => 'required',
            'nama_pic' => 'required',
            'posisi_pic' => 'required',
            'nomor_telepon' => 'required',
            'country' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'jumlah_karyawan' => 'required|integer',
            'tipe_perusahaan' => 'required',
        ]);

        Company::create([
            'user_id' => $request->user_id, // Mengisi user_id dengan ID pengguna yang sedang login
            'nama_perusahaan' => $request->nama_perusahaan,
            'nama_pic' => $request->nama_pic,
            'posisi_pic' => $request->posisi_pic,
            'nomor_telepon' => $request->nomor_telepon,
            'country' => $request->country,
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'jumlah_karyawan' => $request->jumlah_karyawan,
            'tipe_perusahaan' => $request->tipe_perusahaan,
        ]);

        return response()->json(['success' => 'Company created successfully.']);
    }
}
