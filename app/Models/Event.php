<?php

namespace App\Models;

use App\Enums\EventStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;


    public function ticketTypes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TicketType::class);
    }


    protected function casts(): array
    {
        return [
            'status' => EventStatus::class,
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function organizer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function venue(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

}
