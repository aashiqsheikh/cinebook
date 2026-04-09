@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Movie</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.movies.update', $movie->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Movie Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="poster_url" class="form-label">Poster Image URL</label>
                            <input type="url" class="form-control" id="poster_url" name="poster_url" value="{{ old('poster_url', $movie->poster) }}" placeholder="https://example.com/movie-poster.jpg">
                            <small class="text-muted">Enter a valid image URL (jpg, png, jpeg, gif)</small>
                            @if($movie->poster)
                                <div class="mt-2">
                                    <img src="{{ $movie->poster }}" alt="Current Poster" style="max-height: 150px;">
                                </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration (minutes)</label>
                            <input type="number" class="form-control" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <select class="form-select" id="genre" name="genre" required>
                                <option value="">Select Genre</option>
                                <option value="Action" {{ $movie->genre == 'Action' ? 'selected' : '' }}>Action</option>
                                <option value="Comedy" {{ $movie->genre == 'Comedy' ? 'selected' : '' }}>Comedy</option>
                                <option value="Drama" {{ $movie->genre == 'Drama' ? 'selected' : '' }}>Drama</option>
                                <option value="Horror" {{ $movie->genre == 'Horror' ? 'selected' : '' }}>Horror</option>
                                <option value="Sci-Fi" {{ $movie->genre == 'Sci-Fi' ? 'selected' : '' }}>Sci-Fi</option>
                                <option value="Thriller" {{ $movie->genre == 'Thriller' ? 'selected' : '' }}>Thriller</option>
                                <option value="Romance" {{ $movie->genre == 'Romance' ? 'selected' : '' }}>Romance</option>
                                <option value="Animation" {{ $movie->genre == 'Animation' ? 'selected' : '' }}>Animation</option>
                                <option value="Documentary" {{ $movie->genre == 'Documentary' ? 'selected' : '' }}>Documentary</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date', \App\Helpers\DateHelper::formatDateISO($movie->release_date)) }}" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Movie</button>
                            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

