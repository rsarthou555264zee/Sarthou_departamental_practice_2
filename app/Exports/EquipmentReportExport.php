<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EquipmentReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public function __construct(private Collection $records) {}

    public function headings(): array
    {
        return ['Equipment', 'Category', 'Unit Price', 'Availability'];
    }

    public function collection(): Collection
    {
        return $this->records->map(fn ($r) => [
            $r->equipment_name,
            $r->category,
            $r->unit_price,
            $r->availability_status,
        ]);
    }
}
