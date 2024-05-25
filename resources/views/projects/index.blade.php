@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Projects') }}</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
            <th>Speaker</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->judul }}</td>
                <td>{{ $project->deskripsi }}</td>
                <td>{{ $project->tanggal }}</td>
                <td>
                    <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-project" data-project-id="{{ $project->id }}" data-toggle="modal" data-target="#deleteEventModal-{{ $project->id }}">Delete</button>
                    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($projects as $project)
        <div class="modal fade" id="deleteEventModal-{{ $project->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteEventModalLabel-{{ $project->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEventModalLabel-{{ $project->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete project "{{ $project->judul }}" (ID: {{ $project->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
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
