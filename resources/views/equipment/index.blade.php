@extends('layouts.admin')
@section('title', 'Equipment')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Equipment</h3>
    <a href="{{ route('equipment.create') }}" class="btn btn-primary">+ Add Equipment</a>
</div>

<table class="table table-bordered bg-white">
    <thead><tr>
        <th>#</th><th>Name</th><th>Category</th><th>Unit Price</th><th>Status</th><th>Actions</th>
    </tr></thead>
    <tbody>
    @forelse ($equipment as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->equipment_name }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ number_format($item->unit_price, 2) }}</td>
            <td>{{ $item->availability_status }}</td>
            <td>
                <a href="{{ route('equipment.show', $item) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('equipment.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                <form method="POST" action="{{ route('equipment.destroy', $item) }}" class="d-inline"
                      onsubmit="return confirm('Delete this equipment? This cannot be undone.')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center">No equipment yet.</td></tr>
    @endforelse
    </tbody>
</table>

{{ $equipment->links() }}
@endsection