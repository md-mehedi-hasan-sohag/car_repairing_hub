@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="form-container-centered">
    <h1>Edit Service</h1>
    <form action="{{ route('admin.services.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="service_name">Service Name</label>
            <input type="text" id="service_name" name="service_name" class="form-control"
                   value="{{ old('service_name', $service->service_name) }}" required>
            @error('service_name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" id="category" name="category" class="form-control"
                   value="{{ old('category', $service->category) }}">
            @error('category')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control"
                   value="{{ old('price', $service->price) }}" step="0.01" min="0">
            @error('price')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: center; margin-top: 1.5rem;">
            <button type="submit" class="btn btn-primary">Update Service</button>
            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
