@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Indicator') }}</h1>

    <form action="{{ route('indicators.update', $indicator->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $indicator->name }}" required>
        </div>
        <div class="form-group">
            <label for="order">Order:</label>
            <input type="text" class="form-control" id="order" name="order" value="{{ $indicator->order }}" required>
        </div>
        <div class="form-group">
            <label for="level">Level:</label>
            <input type="text" class="form-control" id="level" name="level" value="{{ $indicator->level }}" required>
        </div>
        <div class="form-group">
            <label for="parent_indicator_id">Parent Indicator:</label>
            <select class="form-control" id="parent_indicator_id" name="parent_indicator_id">
                <option value="">None</option>
                @foreach($indicators as $ind)
                    <option value="{{ $ind->id }}" {{ $ind->id == $indicator->parent_indicator_id ? 'selected' : '' }}>{{ $ind->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ $indicator->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="sdg_id">SDG:</label>
            <select class="form-control" id="sdg_id" name="sdg_id" required>
                @foreach($sdgs as $sdg)
                    <option value="{{ $sdg->id }}" {{ $sdg->id == $indicator->sdg_id ? 'selected' : '' }}>{{ $sdg->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
