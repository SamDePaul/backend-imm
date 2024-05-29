@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View Tag') }}</h1>

    <div class="form-group">
        <label for="slug">Slug:</label>
        <input type="text" class="form-control" id="slug" name="slug" value="{{ $metric->slug }}" readonly>
    </div>
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $metric->name }}" readonly>
    </div>
    <a href="{{ route('metrics.index') }}" class="btn btn-secondary">Back</a>
@endsection
