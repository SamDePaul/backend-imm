@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View SDG') }}</h1>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $sdg->name }}" readonly>
    </div>
    <a href="{{ route('sdgs.index') }}" class="btn btn-secondary">Back</a>
@endsection
