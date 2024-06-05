@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Survey') }}</h1>
    <div class="container">
        <form action="{{ route('surveys.update', $survey->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="business_name">Business Name</label>
                <input type="text" name="business_name" class="form-control" value="{{ $survey->business_name }}" required>
            </div>
            <div class="form-group">
                <label for="survey_title">Survey Title</label>
                <input type="text" name="survey_title" class="form-control" value="{{ $survey->survey_title }}" required>
            </div>
            <div class="form-group">
                <label for="survey_description">Survey Description</label>
                <textarea name="survey_description" class="form-control">{{ $survey->survey_description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
