<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Exports\EquipmentReportExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public const REPORTS = [
        'price_list'  => 'Equipment Price List',
        'available'   => 'Available Equipment',
        'unavailable' => 'Unavailable Equipment',
        'by_category' => 'Equipment by Category',
    ];
    private function filters(Request $request): array
    {
        $data = $request->validate([
            'report'   => ['nullable', Rule::in(array_keys(self::REPORTS))],
            'category' => ['nullable', Rule::in(Equipment::CATEGORIES)],
            'status'   => ['nullable', Rule::in(Equipment::STATUSES)],
        ]);

        $report = $data['report'] ?? 'price_list';
        $status = $data['status'] ?? null;
        if ($report === 'available')   $status = 'Available';
        if ($report === 'unavailable') $status = 'Unavailable';

        return [$report, $data['category'] ?? null, $status];
    }
    private function records(?string $category, ?string $status)
    {
        return Equipment::reportFilter($category, $status)
            ->orderBy('category')->orderBy('equipment_name')
            ->get();
    }

    public function index(Request $request)
    {
        [$report, $category, $status] = $this->filters($request);
        $records = $this->records($category, $status);
        $title   = self::REPORTS[$report];

        return view('reports.index', compact('records', 'report', 'category', 'status', 'title'));
    }

    public function pdf(Request $request) 
    { 
    [$report, $category, $status] = $this->filters($request);
    $records = $this->records($category, $status);
    $title   = self::REPORTS[$report];

    return Pdf::loadView('reports.pdf', compact('records', 'category', 'status', 'title'))
        ->download('equipment-report.pdf');
        }

    public function excel(Request $request) 
    { 
    [, $category, $status] = $this->filters($request);
    $records = $this->records($category, $status);

    return Excel::download(new EquipmentReportExport($records), 'equipment-report.xlsx');
    }
}
