@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Sustainable Development Goals (SDGs)') }}</h1>

    <a href="{{ route('sdgs.create') }}" class="btn btn-primary mb-3">Add Project</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th class="w-8">Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sdg2 as $sdg)
            <tr>
                <td>{{ $sdg->order }}</td>
                <td>{{ $sdg->name }}</td>
                <td>
                    <a href="{{ route('sdgs.edit', $sdg->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-sdg" data-sdg-id="{{ $sdg->id }}" data-toggle="modal" data-target="#deleteEventModal-{{ $sdg->id }}">Delete</button>
                    <a href="{{ route('sdgs.show', $sdg->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($sdg2 as $sdg)
        <div class="modal fade" id="deleteEventModal-{{ $sdg->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteEventModalLabel-{{ $sdg->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEventModalLabel-{{ $sdg->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete sdg "{{ $sdg->judul }}" (ID: {{ $sdg->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('sdgs.destroy', $sdg->id) }}" method="POST" style="display:inline-block;">
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
