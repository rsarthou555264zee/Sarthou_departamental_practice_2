<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body  { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>
        Category: {{ $category ?? 'All' }} |
        Availability: {{ $status ?? 'All' }} |
        Generated: {{ now()->format('M d, Y h:i A') }}
    </p>

    <table>
        <thead><tr><th>Equipment</th><th>Category</th><th>Unit Price</th><th>Status</th></tr></thead>
        <tbody>
        @forelse ($records as $r)
            <tr>
                <td>{{ $r->equipment_name }}</td>
                <td>{{ $r->category }}</td>
                <td>{{ number_format($r->unit_price, 2) }}</td>
                <td>{{ $r->availability_status }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No equipment matches the selected filters.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>