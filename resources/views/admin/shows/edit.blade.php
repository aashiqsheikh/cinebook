@extends('layouts.app')

@section('styles')
<style>
    .admin-header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: white; padding: 50px 0; margin-bottom: 50px; }
</style>
@endsection

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="fw-bold"><i class="fas fa-edit me-2"></i>Edit Show</h1>
        <p class="mb-0">Update show timing</p>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.shows.update', $show->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label for="movie_id" class="form-label">Movie</label>
                            <select class="form-select" id="movie_id" name="movie_id" required>
                                @foreach($movies as $movie)
                                    <option value="{{ $movie->id }}" {{ $show->movie_id == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="theatre_id" class="form-label">Theatre</label>
                            <select class="form-select" id="theatre_id" name="theatre_id" required>
                                @foreach($theatres as $theatre)
                                    <option value="{{ $theatre->id }}" {{ $show->theatre_id == $theatre->id ? 'selected' : '' }}>{{ $theatre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="show_date" class="form-label">Show Date</label>
                            <input type="date" class="form-control" id="show_date" name="show_date" value="{{ \App\Helpers\DateHelper::formatDateISO($show->show_date) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="show_time" class="form-label">Show Time</label>
                            <input type="time" class="form-control" id="show_time" name="show_time" value="{{ \App\Helpers\DateHelper::formatTime24Hour($show->show_time) }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₹)</label>
                            <input type="number" class="form-control" id="price" name="price" value="{{ $show->price }}" required min="0" step="0.01">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.shows.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Show</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

