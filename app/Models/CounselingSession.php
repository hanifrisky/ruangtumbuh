<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CounselingSession extends Model
{
    protected $fillable = [
        'konseli_id',
        'konselor_id',
        'session_number',
        'scheduled_at',
        'platform',
        'meeting_url',
        'status',
        'counselor_evaluation_notes',
    ];

    protected function casts(): array
    {
        return [
            'scheduled_at' => 'datetime',
            'session_number' => 'integer',
        ];
    }

    public function konseli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }

    public function konselor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konselor_id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'counseling_session_id');
    }

    public function reflections(): HasMany
    {
        return $this->hasMany(SessionReflection::class, 'counseling_session_id');
    }

    public function latestReflection(): HasOne
    {
        return $this->hasOne(SessionReflection::class, 'counseling_session_id')->latestOfMany();
    }
}
