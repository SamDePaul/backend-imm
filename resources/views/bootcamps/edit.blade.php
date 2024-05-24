@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ $bootcamp->exists ? __('Edit Bootcamp') : __('Create Bootcamp') }}</h1>

    <form action="{{ $bootcamp->exists ? route('bootcamps.update', $bootcamp->id) : route('bootcamps.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($bootcamp->exists)
            @method('PUT')
        @endif
        <div class="form-group">
            <label for="judul">Title</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $bootcamp->judul) }}" required>
        </div>
        <div class="form-group">
            <label for="deskripsi">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $bootcamp->deskripsi) }}</textarea>
        </div>
        <div class="form-group">
            <label for="tanggal">Date</label>
            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', \Carbon\Carbon::parse($bootcamp->tanggal)->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div class="form-group">
            <label for="pembicara">Speaker</label>
            <input type="text" class="form-control" id="pembicara" name="pembicara" value="{{ old('pembicara', $bootcamp->pembicara) }}" required>
        </div>
        <div class="form-group">
            <label for="poster_path">Poster</label>
            <input type="file" class="form-control-file" id="poster_path" name="poster_path" accept="image/*">
        </div>
        @if($bootcamp->poster_path)
            <div class="form-group">
                <label>Current Poster</label><br>
                <img src="{{ asset('storage/'.$bootcamp->poster_path) }}" alt="Current Poster" style="max-width: 200px;">
            </div>
        @endif
        <div class="d-flex align-items-center">
            <button type="submit" class="btn btn-primary mr-3">
                {{ $bootcamp->exists ? __('Update Bootcamp') : __('Create Bootcamp') }}
            </button>
            <a href="{{ route('bootcamps.index') }}" class="btn btn-secondary">Back to Bootcamps</a>
        </div>
    </form>
@endsection
