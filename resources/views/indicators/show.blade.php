@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View Indicator') }}</h1>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $indicator->name }}" readonly>
    </div>
    <div class="form-group">
        <label for="order">Order:</label>
        <input type="text" class="form-control" id="order" name="order" value="{{ $indicator->order }}" readonly>
    </div>
    <div class="form-group">
        <label for="level">Level:</label>
        <input type="text" class="form-control" id="level" name="level" value="{{ $indicator->level }}" readonly>
    </div>
    <div class="form-group">
        <label for="parent_indicator_id">Parent Indicator:</label>
        <input type="text" class="form-control" id="parent_indicator_id" name="parent_indicator_id" value="{{ optional($indicator->parent)->name }}" readonly>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea class="form-control" id="description" name="description" readonly>{{ $indicator->description }}</textarea>
    </div>
    <div class="form-group">
        <label for="sdg_id">SDG:</label>
        <input type="text" class="form-control" id="sdg_id" name="sdg_id" value="{{ $indicator->sdg->name }}" readonly>
    </div>
    <a href="{{ route('indicators.index') }}" class="btn btn-secondary">Back</a>
@endsection
