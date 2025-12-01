@extends('layouts.app')

@section('title', 'Manage Services')

@section('content')
<h1>Manage Your Services</h1>

<div class="card">
    <h2>Add New Service</h2>
    <form action="{{ route('shop-owner.services.store') }}" method="POST">
        @csrf
        <div class="grid">
            <div class="form-group">
                <label for="service_id">Service</label>
                <select id="service_id" name="service_id" class="form-control" required>
                    <option value="">Select a service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->service_name }}{{ $service->price ? ' - Base Price: $' . number_format($service->price, 2) : '' }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="cost">Price ($)</label>
                <input type="number" id="cost" name="cost" class="form-control"
                       step="0.01" min="0" required>
                @error('cost')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="notes">Notes (Optional)</label>
            <textarea id="notes" name="notes" class="form-control" rows="2"></textarea>
            @error('notes')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-success">Add Service</button>
    </form>
</div>

<div class="card">
    <h2>Your Offered Services</h2>
    @if($offeredServices->isEmpty())
        <p>You haven't added any services yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Service Name</th>
                    <th>Price</th>
                    <th>Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offeredServices as $offered)
                    <tr>
                        <td>{{ $offered->service->service_name }}</td>
                        <td>
                            <form action="{{ route('shop-owner.services.update', $offered->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="number" name="cost" value="{{ $offered->cost }}"
                                       step="0.01" min="0" style="width: 100px;" required>
                                <button type="submit" class="btn btn-primary" style="padding: 0.5rem;">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('shop-owner.services.update', $offered->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="cost" value="{{ $offered->cost }}">
                                <input type="text" name="notes" value="{{ $offered->notes }}"
                                       style="width: 200px;">
                                <button type="submit" class="btn btn-primary" style="padding: 0.5rem;">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('shop-owner.services.destroy', $offered->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Remove this service?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
