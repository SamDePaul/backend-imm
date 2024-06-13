<!-- resources/views/project_reports/create.blade.php -->
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Buat Laporan Proyek Baru</h1>
    <form action="{{ route('project_reports.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="project_id">ID Proyek</label>
            <select class="form-control" id="project_id" name="project_id" required>
                @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="report_date">Tanggal Laporan</label>
            <input type="datetime-local" class="form-control" id="report_date" name="report_date" required>
        </div>
        <div class="form-group">
            <label for="impact_measure">Dampak</label>
            <input type="text" class="form-control" id="impact_measure" name="impact_measure">
        </div>
        <div class="form-group">
            <label for="progress_percentage">Persentase Kemajuan</label>
            <input type="number" class="form-control" id="progress_percentage" name="progress_percentage" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
