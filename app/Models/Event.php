<?php

namespace App\Models;

use App\Enums\Golf\EventFormat;
use App\Enums\Golf\EventStatus;
use App\Enums\Golf\EventType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'start',
        'end',
        'allDay',
        'className',
        'description',
        'course_id',
        'type',
        'format',
        'status',
        'registration_fee',
        'registration_starts_at',
        'registration_ends_at',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
        'allDay' => 'boolean',
        'type' => EventType::class,
        'format' => EventFormat::class,
        'status' => EventStatus::class,
        'registration_fee' => 'decimal:2',
        'registration_starts_at' => 'datetime',
        'registration_ends_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function registrations(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot('status')
            ->withTimestamps();
    }

    public function isRegistrationOpen(): bool
    {
        if ($this->type !== EventType::Tournament) {
            return false;
        }

        $now = now();

        return $this->status === EventStatus::Open
            && ($this->registration_starts_at === null || $this->registration_starts_at <= $now)
            && ($this->registration_ends_at === null || $this->registration_ends_at >= $now);
    }
}