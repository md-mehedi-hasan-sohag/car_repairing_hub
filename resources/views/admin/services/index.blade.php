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
                <th>Description</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>
                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="service_name" value="{{ $service->service_name }}"
                                   style="width: 200px;" required>
                            <input type="hidden" name="category" value="{{ $service->category }}">
                            <input type="hidden" name="description" value="{{ $service->description }}">
                            <button type="submit" class="btn btn-primary" style="padding: 0.5rem;">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('admin.services.update', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="service_name" value="{{ $service->service_name }}">
                            <input type="text" name="category" value="{{ $service->category }}"
                                   style="width: 150px;">
                            <input type="hidden" name="description" value="{{ $service->description }}">
                            <button type="submit" class="btn btn-primary" style="padding: 0.5rem;">Update</button>
                        </form>
                    </td>
                    <td>{{ Str::limit($service->description, 50) ?? '-' }}</td>
                    <td>{{ $service->created_at->format('M d, Y') }}</td>
                    <td>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">No services found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 1rem;">
        {{ $services->links() }}
    </div>
</div>
@endsection
