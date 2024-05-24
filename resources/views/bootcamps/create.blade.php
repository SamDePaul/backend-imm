@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Bootcamp') }}</h1>

    <form action="{{ route('bootcamps.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="poster_path">Poster</label>
            <input type="file" class="form-control-file" id="poster_path" name="poster_path" accept="image/*" required>
        </div>
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">{{ __('Create Bootcamp') }}</button>
            <a href="{{ route('bootcamps.index') }}" class="btn btn-secondary">{{ __('Back to Bootcamps') }}</a>
        </div>
    </form>
@endsection
