<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
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

        Company::create($request->all());

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
}
