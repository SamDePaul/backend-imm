@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Project Details') }}</h1>

    <div class="card">
        <div class="card-body">
            <h4>{{ $project->judul }}</h4>
            <p>{{ $project->deskripsi }}</p>
            <p><strong>{{ __('Propose:') }}</strong> {{ $project->tujuan }}</p>
            <p><strong>{{ __('Target Customer:') }}</strong> {{ $project->targetPelanggan }}</p>
            <p><strong>{{ __('User:') }}</strong> {{ $project->user->email }}</p>
            <p><strong>{{ __('Start Date:') }}</strong> {{ $project->tanggalMulai }}</p>
            <p><strong>{{ __('End Date:') }}</strong> {{ $project->tanggalSelesai }}</p>
            <p><strong>{{ __('Country:') }}</strong> {{ $project->country->name }}</p>
            <p><strong>{{ __('Category:') }}</strong> {{ $project->kategori }}</p>
            <p><strong>{{ __('Funding:') }}</strong> {{ $project->dana }}</p>
            <p><strong>{{ __('Funding Type:') }}</strong> {{ $project->jenis_dana }}</p>
            <p><strong>{{ __('Other Funding:') }}</strong> {{ $project->dana_lain }}</p>
            <p><strong>{{ __('SDG:') }}</strong> {{ $project->sdg->name }}</p>
            <p><strong>{{ __('Indicator:') }}</strong> {{ $project->indikator_id }}</p>
            <p><strong>{{ __('Metric:') }}</strong> {{ $project->matrik_id }}</p>

            <div class="d-flex align-items-center">
                <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-warning mr-3">{{ __('Edit Project') }}</a>
                <a href="{{ route('projects.index') }}" class="btn btn-secondary">{{ __('Back to Projects') }}</a>
            </div>
        </div>
    </div>
@endsection
