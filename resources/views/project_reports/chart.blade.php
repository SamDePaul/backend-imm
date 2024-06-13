<!-- resources/views/project_reports/chart.blade.php -->
@extends('layouts.admin')

@section('main-content')
<div class="container">
    <h1>Grafik Kemajuan Proyek</h1>
    <canvas id="projectChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
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
</script>
@endsection
