<!-- resources/views/project_reports/index.blade.php -->
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Daftar Laporan Proyek</h1>
    <a href="{{ route('project_reports.create') }}" class="btn btn-primary">Buat Laporan Baru</a>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Proyek</th>
                <th>Tanggal Laporan</th>
                <th>Persentase Kemajuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projectReports as $report)
            <tr>
                <td>{{ $report->id }}</td>
                <td>{{ $report->project_id }}</td>
                <td>{{ $report->report_date }}</td>
                <td>{{ $report->progress_percentage }}%</td>
                <td>
                    <a href="{{ route('project_reports.show', $report->id) }}" class="btn btn-info">Lihat</a>
                    <a href="{{ route('project_reports.edit', $report->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('project_reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
