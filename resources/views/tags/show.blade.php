@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View Tag Detail') }}</h1>
    <div class="card">
        <div class="card-header">
            Tag Details
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $tag->id }}</p>
            <p><strong>Name:</strong> {{ $tag->nama }}</p>
            <p><strong>Parent ID:</strong> {{ $tag->parent_id }}</p>
        </div>
    </div>
    <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back</a>
@endsection
