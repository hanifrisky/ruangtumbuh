<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionReflection extends Model
{
    protected $fillable = [
        'counseling_session_id',
        'konseli_id',
        'answer_1',
        'answer_2',
        'answer_3',
        'submitted_at',
    ];

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
        ];
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(CounselingSession::class, 'counseling_session_id');
    }

    public function konseli(): BelongsTo
    {
        return $this->belongsTo(User::class, 'konseli_id');
    }
}
