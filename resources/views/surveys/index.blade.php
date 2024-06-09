@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Surveys') }}</h1>
    <a href="{{ route('surveys.create') }}" class="btn btn-primary mb-4">Add Surveys</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Business Name</th>
                    <th>Survey Title</th>
                    <th>Survey Description</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>No HP</th>
                    <th>Pertanyaan 1</th>
                    <th>Pertanyaan 2</th>
                    <th>Pertanyaan 3</th>
                    <th>Pertanyaan 4</th>
                    <th>Pertanyaan 5</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($surveys as $survey)
                    <tr>
                        <td>{{ $survey->id }}</td>
                        <td>{{ $survey->business_name }}</td>
                        <td>{{ $survey->survey_title }}</td>
                        <td>{{ $survey->survey_description }}</td>
                        <td>{{ $survey->nama_lengkap }}</td>
                        <td>{{ $survey->email }}</td>
                        <td>{{ $survey->no_hp }}</td>
                        <td>{{ $survey->pertanyaan_1 }}</td>
                        <td>{{ $survey->pertanyaan_2 }}</td>
                        <td>{{ $survey->pertanyaan_3 }}</td>
                        <td>{{ $survey->pertanyaan_4 }}</td>
                        <td>{{ $survey->pertanyaan_5 }}</td>
                        <td>
                            <a href="{{ route('surveys.edit', $survey->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('surveys.destroy', $survey->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a href="{{ route('surveys.show', $survey->id) }}" class="btn btn-info">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
