<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id', 'name', 'price_cents', 'currency',
        'quantity_total', 'max_per_order', 'sales_start_at', 'sales_end_at',
    ];

    protected function casts(): array
    {
        return [
            'price_cents' => 'integer',
            'quantity_total' => 'integer',
            'quantity_sold' => 'integer',
            'quantity_held' => 'integer',
            'sales_start_at' => 'datetime',
            'sales_end_at' => 'datetime',
        ];
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function available(): int
    {
        return $this->quantity_total - $this->quantity_sold - $this->quantity_held;
    }
}