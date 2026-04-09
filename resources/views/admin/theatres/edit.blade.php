@extends('layouts.app')

@section('styles')
<style>
    .admin-header { background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%); color: white; padding: 50px 0; margin-bottom: 50px; }
</style>
@endsection

@section('content')
<div class="admin-header">
    <div class="container">
        <h1 class="fw-bold"><i class="fas fa-edit me-2"></i>Edit Theatre</h1>
        <p class="mb-0">Update theatre information</p>
    </div>
</div>
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.theatres.update', $theatre->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Theatre Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $theatre->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ $theatre->location }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="total_seats" class="form-label">Total Seats</label>
                            <input type="number" class="form-control" id="total_seats" name="total_seats" value="{{ $theatre->total_seats }}" required min="1">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.theatres.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Theatre</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

