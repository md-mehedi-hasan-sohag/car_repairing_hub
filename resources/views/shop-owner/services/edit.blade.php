@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="form-container-centered">
    <h1>Edit Service</h1>
    <form action="{{ route('shop-owner.services.update', $offeredService->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" id="service_name" class="form-control"
                   value="{{ $offeredService->service->service_name }}" disabled>
        </div>

        <div class="form-group">
            <label for="cost">Price ($)</label>
            <input type="number" id="cost" name="cost" class="form-control"
                   value="{{ old('cost', $offeredService->cost) }}" step="0.01" min="0" required>
            @error('cost')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="notes">Notes</label>
            <textarea id="notes" name="notes" class="form-control" rows="4">{{ old('notes', $offeredService->notes) }}</textarea>
            @error('notes')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('shop-owner.services.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
