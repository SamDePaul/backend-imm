@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Project Details') }}</h1>

    <div class="card">
        <div class="card-header">
            Project Details
        </div>
        <div class="card-body">
            @if($project->poster_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $project->poster_path) }}" alt="Project Poster" style="max-width: 200px;">
                </div>
            @endif
            <p><strong>Title:</strong> {{ $project->judul }}</p>
            <p><strong>Description:</strong> {{ $project->deskripsi }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($project->tanggal)->format('d M Y, H:i') }}</p>
            <p><strong>Price:</strong> {{ 'Rp ' . number_format($project->harga, 0, ',', '.') }}</p>
            <p><strong>Created At:</strong> {{ $project->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $project->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('projects.index') }}" class="btn btn-secondary mt-3">Back to Projects</a>
@endsection
