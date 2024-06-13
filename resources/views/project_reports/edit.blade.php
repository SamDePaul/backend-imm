<!-- resources/views/project_reports/edit.blade.php -->
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Edit Laporan Proyek</h1>
    <form action="{{ route('project_reports.update', $projectReport->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="project_id">ID Proyek</label>
            <select class="form-control" id="project_id" name="project_id" required>
                @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ $project->id == $projectReport->project_id ? 'selected' : '' }}>{{ $project->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="report_date">Tanggal Laporan</label>
            <input type="datetime-local" class="form-control" id="report_date" name="report_date" value="{{ \Carbon\Carbon::parse($projectReport->report_date)->format('Y-m-d\TH:i') }}" required>
        </div>
        <div class="form-group">
            <label for="impact_measure">Dampak</label>
            <input type="text" class="form-control" id="impact_measure" name="impact_measure" value="{{ $projectReport->impact_measure }}">
        </div>
        <div class="form-group">
            <label for="progress_percentage">Persentase Kemajuan</label>
            <input type="number" class="form-control" id="progress_percentage" name="progress_percentage" step="0.01" value="{{ $projectReport->progress_percentage }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
</div>
@endsection
