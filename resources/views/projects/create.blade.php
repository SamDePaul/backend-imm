@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Project') }}</h1>

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Title</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi') }}</textarea>
        </div>
        <div class="form-group">
            <label for="tanggal">Date</label>
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
        </div>
        <div class="form-group">
            <label for="harga">Price (Rp)</label>
            <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control" id="harga" name="harga" value="{{ old('harga') }}" required>
        </div>
        <div class="form-group">
            <label for="poster_path">Poster</label>
            <input type="file" class="form-control-file" id="poster_path" name="poster_path" accept="image/*" required>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">{{ __('Create Project') }}</button>
            <a href="{{ route('projects.index') }}" class="btn btn-secondary">{{ __('Back to Projects') }}</a>
        </div>
    </form>
@endsection
