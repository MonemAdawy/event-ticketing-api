<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = ['booking_item_id', 'code', 'status', 'checked_in_at', 'pdf_path'];

    protected function casts(): array
    {
        return [
            'status' => TicketStatus::class,
            'checked_in_at' => 'datetime',
        ];
    }

    public function bookingItem(): BelongsTo
    {
        return $this->belongsTo(BookingItem::class);
    }

    public function isUsed(): bool
    {
        return $this->status === TicketStatus::Used;
    }

    public static function generateCode(): string
    {
        do {
            $code = strtoupper(Str::random(12));
        } while (static::where('code', $code)->exists());

        return $code;
    }
}