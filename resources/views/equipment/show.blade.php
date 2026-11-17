@extends('layouts.admin')
@section('title', 'View Equipment')

@section('content')
<h3>{{ $equipment->equipment_name }}</h3>

<table class="table table-bordered bg-white" style="max-width: 600px;">
    <tr>
        <th style="width: 180px;">Category</th>
        <td>{{ $equipment->category }}</td>
    </tr>
    <tr>
        <th>Unit price</th>
        <td>{{ number_format($equipment->unit_price, 2) }}</td>
    </tr>
    <tr>
        <th>Availability</th>
        <td>{{ $equipment->availability_status }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $equipment->description }}</td>
    </tr>
    <tr>
        <th>Added by</th>
        {{-- user() is the belongsTo relationship defined in the Equipment model --}}
        <td>{{ $equipment->user->name }}</td>
    </tr>
    <tr>
        <th>Created</th>
        <td>{{ $equipment->created_at->format('M d, Y h:i A') }}</td>
    </tr>
    <tr>
        <th>Last updated</th>
        <td>{{ $equipment->updated_at->format('M d, Y h:i A') }}</td>
    </tr>
</table>

<a href="{{ route('equipment.edit', $equipment) }}" class="btn btn-warning">Edit</a>
<a href="{{ route('equipment.index') }}" class="btn btn-secondary">Back to list</a>
@endsection