@extends('layouts.app')

@section('title', 'Manage Services')

@section('content')
<h1>Service Catalog Management</h1>

<div class="card">
    <h2>Add New Service</h2>
    <form action="{{ route('admin.services.store') }}" method="POST">
        @csrf
        <div class="grid">
            <div class="form-group">
                <label for="service_name">Service Name</label>
                <input type="text" id="service_name" name="service_name" class="form-control"
                       value="{{ old('service_name') }}" required>
                @error('service_name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Category (Optional)</label>
                <input type="text" id="category" name="category" class="form-control"
                       value="{{ old('category') }}">
                @error('category')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price (Optional)</label>
                <input type="number" id="price" name="price" class="form-control"
                       value="{{ old('price') }}" step="0.01" min="0">
                @error('price')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description (Optional)</label>
            <textarea id="description" name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>
</div>

<div class="card">
    <h2>All Services ({{ $services->total() }} total)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Service Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Description</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->category ?? '-' }}</td>
                    <td>{{ $service->price ? '$' . number_format($service->price, 2) : '-' }}</td>
                    <td>{{ Str::limit($service->description, 50) ?? '-' }}</td>
                    <td>{{ $service->created_at->format('M d, Y') }}</td>
                    <td>
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No services found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $services->links() }}
    </div>
</div>
@endsection
