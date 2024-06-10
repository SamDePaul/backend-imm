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
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $survey->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $survey->email }}</td>
            </tr>
            <tr>
                <th>No HP</th>
                <td>{{ $survey->no_hp }}</td>
            </tr>
            <tr>
                <th>Pertanyaan 1</th>
                <td>{{ $survey->pertanyaan_1 }}</td>
            </tr>
            <tr>
                <th>Pertanyaan 2</th>
                <td>{{ $survey->pertanyaan_2 }}</td>
            </tr>
            <tr>
                <th>Pertanyaan 3</th>
                <td>{{ $survey->pertanyaan_3 }}</td>
            </tr>
            <tr>
                <th>Pertanyaan 4</th>
                <td>{{ $survey->pertanyaan_4 }}</td>
            </tr>
            <tr>
                <th>Pertanyaan 5</th>
                <td>{{ $survey->pertanyaan_5 }}</td>
            </tr>
        </table>
        <a href="{{ route('surveys.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
