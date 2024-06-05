@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Survey Details') }}</h1>
    <div class="container">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td>{{ $survey->id }}</td>
            </tr>
            <tr>
                <th>Business Name</th>
                <td>{{ $survey->business_name }}</td>
            </tr>
            <tr>
                <th>Survey Title</th>
                <td>{{ $survey->survey_title }}</td>
            </tr>
            <tr>
                <th>Survey Description</th>
                <td>{{ $survey->survey_description }}</td>
            </tr>
        </table>
        <a href="{{ route('surveys.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
