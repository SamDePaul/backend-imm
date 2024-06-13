<!-- resources/views/project_reports/show.blade.php -->
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Detail Laporan Proyek</h1>
    <table class="table">
        <tr>
            <th>ID</th>
            <td>{{ $projectReport->id }}</td>
        </tr>
        <tr>
            <th>ID Proyek</th>
            <td>{{ $projectReport->project_id }}</td>
        </tr>
        <tr>
            <th>Tanggal Laporan</th>
            <td>{{ $projectReport->report_date }}</td>
        </tr>
        <tr>
            <th>Dampak</th>
            <td>{{ $projectReport->impact_measure }}</td>
        </tr>
        <tr>
            <th>Persentase Kemajuan</th>
            <td>{{ $projectReport->progress_percentage }}%</td>
        </tr>
    </table>
    <a href="{{ route('project_reports.edit', $projectReport->id) }}" class="btn btn-warning">Edit</a>
    <form action="{{ route('project_reports.destroy', $projectReport->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>

    <div class="mt-4">
        <h2>Grafik Kemajuan Proyek</h2>
        <canvas id="projectChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('projectChart').getContext('2d');
        var projectChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($dates) !!},
                datasets: [{
                    label: 'Persentase Kemajuan',
                    data: {!! json_encode($progress) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
