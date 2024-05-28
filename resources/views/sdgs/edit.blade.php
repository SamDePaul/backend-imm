@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $project->exists ? __('Edit Project') : __('Create Project') }}</h1>

    <form action="{{ $project->exists ? route('projects.update', $project->id) : route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($project->exists)
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="judul">Title</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $project->judul) }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $project->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tanggal">Date</label>
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($project->tanggal)->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Price (Rp)</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="harga" name="harga" value="{{ old('harga', $project->harga) }}" required>
        </div>
        <div class="form-group">
            <label for="poster_path">Poster</label>
            <input type="file" class="form-control-file" id="poster_path" name="poster_path" accept="image/*">
        </div>
        @if($project->poster_path)
            <div class="form-group">
                <label>Current Poster</label><br>
                <img src="{{ asset('storage/'.$project->poster_path) }}" alt="Current Poster" style="max-width: 200px;">
            </div>
        @endif
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">
                {{ $project->exists ? __('Update Project') : __('Create Project') }}
            </button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back to Projects</a>
        </div>
    </form>
@endsection
