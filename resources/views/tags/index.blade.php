@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tags') }}</h1>

    <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add Tag</a>

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
        @foreach($tags as $tag)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tag->nama }}</td>
                <td>
                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-tag" data-tag-id="{{ $tag->id }}" data-toggle="modal" data-target="#deleteTagModal-{{ $tag->id }}">Delete</button>
                    <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($tags as $tag)
        <div class="modal fade" id="deleteTagModal-{{ $tag->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteTagModalLabel-{{ $tag->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTagModalLabel-{{ $tag->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete tag "{{ $tag->name }}" (ID: {{ $tag->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" style="display:inline-block;">
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
