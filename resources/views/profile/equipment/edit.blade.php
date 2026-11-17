@extends('layouts.admin')
@section('title', 'Edit Equipment')

@section('content')
<h3>Edit Equipment</h3>
<form method="POST" action="{{ route('equipment.update', $equipment) }}">
    @csrf
    @method('PUT')
    @include('equipment._form')
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection