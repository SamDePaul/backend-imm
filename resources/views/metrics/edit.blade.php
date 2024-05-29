@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Tag') }}</h1>

    <form action="{{ route('metrics.update', $metric->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="slug">Slug:</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ $metric->slug }}" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $metric->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
