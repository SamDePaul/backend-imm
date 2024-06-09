@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Survey') }}</h1>
    <div class="container">
        <form action="{{ route('surveys.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="business_name">Business Name</label>
                <input type="text" name="business_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="survey_title">Survey Title</label>
                <input type="text" name="survey_title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="survey_description">Survey Description</label>
                <textarea name="survey_description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="no_hp">No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="pertanyaan_1">Pertanyaan 1</label>
                <textarea name="pertanyaan_1" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="pertanyaan_2">Pertanyaan 2</label>
                <textarea name="pertanyaan_2" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="pertanyaan_3">Pertanyaan 3</label>
                <textarea name="pertanyaan_3" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="pertanyaan_4">Pertanyaan 4</label>
                <textarea name="pertanyaan_4" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="pertanyaan_5">Pertanyaan 5</label>
                <textarea name="pertanyaan_5" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
