@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Indicators') }}</h1>

    <a href="{{ route('indicators.create') }}" class="btn btn-primary mb-3">Add Indicator</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Order</th>
            <th>Level</th>
            <th>Parent Indicator</th>
            <th>Description</th>
            <th>SDG</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($indicators as $indicator)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $indicator->name }}</td>
                <td>{{ $indicator->order }}</td>
                <td>{{ $indicator->level }}</td>
                <td>{{ optional($indicator->parent)->name }}</td>
                <td>{{ $indicator->description }}</td>
                <td>{{ $indicator->sdg->name }}</td>
                <td>
                    <a href="{{ route('indicators.edit', $indicator->id) }}" class="btn btn-warning">Edit</a>
                    <button type="button" class="btn btn-danger delete-indicator" data-indicator-id="{{ $indicator->id }}" data-toggle="modal" data-target="#deleteIndicatorModal-{{ $indicator->id }}">Delete</button>
                    <a href="{{ route('indicators.show', $indicator->id) }}" class="btn btn-info">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @foreach($indicators as $indicator)
        <div class="modal fade" id="deleteIndicatorModal-{{ $indicator->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="deleteIndicatorModalLabel-{{ $indicator->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteIndicatorModalLabel-{{ $indicator->id }}">Confirm Deletion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete indicator "{{ $indicator->name }}" (ID: {{ $indicator->id }})? This action cannot be undone.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="{{ route('indicators.destroy', $indicator->id) }}" method="POST" style="display:inline-block;">
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
