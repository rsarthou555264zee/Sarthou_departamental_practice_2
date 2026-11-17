@extends('layouts.admin')
@section('title', 'Reports')

@section('content')
<h3>Equipment Reports</h3>

{{-- GET form: filters live in the URL so exports can reuse them --}}
<form method="GET" action="{{ route('reports.index') }}" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="report" class="form-select">
            @foreach (\App\Http\Controllers\ReportController::REPORTS as $key => $label)
                <option value="{{ $key }}" @selected($report === $key)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="category" class="form-select">
            <option value="">All categories</option>
            @foreach (\App\Models\Equipment::CATEGORIES as $c)
                <option value="{{ $c }}" @selected($category === $c)>{{ $c }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">All statuses</option>
            @foreach (\App\Models\Equipment::STATUSES as $s)
                <option value="{{ $s }}" @selected($status === $s)>{{ $s }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-primary">Apply</button>
        {{-- Reset = same page with no query string --}}
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

<div class="mb-3">
    {{-- request()->query() carries the current filters into the export links --}}
    <a href="{{ route('reports.pdf', request()->query()) }}" class="btn btn-danger">Export PDF</a>
    <a href="{{ route('reports.excel', request()->query()) }}" class="btn btn-success">Export Excel</a>
</div>

<h5>{{ $title }}</h5>

<table class="table table-bordered bg-white">
    <thead><tr>
        <th>Equipment</th><th>Category</th><th>Unit Price</th><th>Status</th>
    </tr></thead>
    <tbody>
    @forelse ($records as $r)
        <tr>
            <td>{{ $r->equipment_name }}</td>
            <td>{{ $r->category }}</td>
            <td>{{ number_format($r->unit_price, 2) }}</td>
            <td>{{ $r->availability_status }}</td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center">No equipment matches the selected filters.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection