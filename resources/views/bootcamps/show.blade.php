@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Bootcamp Details') }}</h1>

    <div class="card">
        <div class="card-header">
            Bootcamp Details
        </div>
        <div class="card-body">
            @if($bootcamp->poster_path)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $bootcamp->poster_path) }}" alt="Bootcamp Poster" style="max-width: 200px;">
                </div>
            @endif
            <p><strong>Title:</strong> {{ $bootcamp->judul }}</p>
            <p><strong>Description:</strong> {{ $bootcamp->deskripsi }}</p>
            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($bootcamp->tanggal)->format('d M Y, H:i') }}</p>
            <p><strong>Speaker:</strong> {{ $bootcamp->pembicara }}</p>
            <p><strong>Created At:</strong> {{ $bootcamp->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $bootcamp->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('bootcamps.index') }}" class="btn btn-secondary mt-3">Back to Bootcamps</a>
@endsection
