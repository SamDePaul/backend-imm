@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tags') }}</h1>

    <a href="{{ route('metrics.create') }}" class="btn btn-primary mb-3">Add Tag</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($metrics as $metric)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $metric->name }}</td>
                <td>
                    <a href="{{ route('metrics.edit', $metric->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-metric" data-metric-id="{{ $metric->id }}" data-toggle="modal" data-target="#deleteTagModal-{{ $metric->id }}">Delete</button>
                    <a href="{{ route('metrics.show', $metric->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($metrics as $metric)
        <div class="modal fade" id="deleteTagModal-{{ $metric->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteTagModalLabel-{{ $metric->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTagModalLabel-{{ $metric->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete metric "{{ $metric->name }}" (ID: {{ $metric->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('metrics.destroy', $metric->id) }}" method="POST" style="display:inline-block;">
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
