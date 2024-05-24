@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Bootcamps') }}</h1>

    <a href="{{ route('bootcamps.create') }}" class="btn btn-primary mb-3">Add Bootcamp</a>

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
        @foreach($bootcamps as $bootcamp)
            <tr>
                <td>{{ $bootcamp->id }}</td>
                <td>{{ $bootcamp->judul }}</td>
                <td>{{ $bootcamp->deskripsi }}</td>
                <td>{{ $bootcamp->tanggal }}</td>
                <td>{{ $bootcamp->pembicara }}</td>
                <td>
                    <a href="{{ route('bootcamps.edit', $bootcamp->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-bootcamp" data-bootcamp-id="{{ $bootcamp->id }}" data-toggle="modal" data-target="#deleteEventModal-{{ $bootcamp->id }}">Delete</button>
                    <a href="{{ route('bootcamps.show', $bootcamp->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($bootcamps as $bootcamp)
        <div class="modal fade" id="deleteEventModal-{{ $bootcamp->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteEventModalLabel-{{ $bootcamp->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteEventModalLabel-{{ $bootcamp->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete bootcamp "{{ $bootcamp->judul }}" (ID: {{ $bootcamp->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('bootcamps.destroy', $bootcamp->id) }}" method="POST" style="display:inline-block;">
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
