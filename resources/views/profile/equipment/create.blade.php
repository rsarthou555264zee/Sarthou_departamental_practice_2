@extends('layouts.admin')
@section('title', 'Add Equipment')

@section('content')
<h3>Add Equipment</h3>
<form method="POST" action="{{ route('equipment.store') }}">
    @csrf
    @include('equipment._form')
    <button class="btn btn-primary">Save</button>
    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection