@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Companies') }}</h1>

    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Add Company</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Perusahaan</th>
            <th>Nama PIC</th>
            <th>Nomor Telepon</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $company->nama_perusahaan }}</td>
                <td>{{ $company->nama_pic }}</td>
                <td>{{ $company->nomor_telepon }}</td>
                <td>
                    <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-company" data-company-id="{{ $company->id }}" data-toggle="modal" data-target="#deleteCompanyModal-{{ $company->id }}">Delete</button>
                    <a href="{{ route('companies.show', $company->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($companies as $company)
        <div class="modal fade" id="deleteCompanyModal-{{ $company->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteCompanyModalLabel-{{ $company->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteCompanyModalLabel-{{ $company->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete company "{{ $company->nama_perusahaan }}" (ID: {{ $company->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
