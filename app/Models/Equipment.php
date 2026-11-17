<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipment';
    protected $fillable = [
        'equipment_name', 'category', 'unit_price',
        'description', 'availability_status',
    ];

    public const CATEGORIES = ['Paddles', 'Balls', 'Nets', 'Accessories'];
    public const STATUSES   = ['Available', 'Unavailable'];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function scopeReportFilter(Builder $query, ?string $category, ?string $status): Builder
    {
        return $query
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($status,   fn ($q) => $q->where('availability_status', $status));
    }
}
