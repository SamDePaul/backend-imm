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
                <th>{{ __('Title') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Start Date') }}</th>
                <th>{{ __('End Date') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->judul }}</td>
                    <td>{{ $project->deskripsi }}</td>
                    <td>{{ $project->tanggalMulai }}</td>
                    <td>{{ $project->tanggalSelesai }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-info">{{ __('View') }}</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                        <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $projects->links() }}

@endsection
