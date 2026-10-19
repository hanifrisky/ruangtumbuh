<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $fillable = [
        'counseling_session_id',
        'konseli_id',
        'konselor_id',
        'sender_id',
        'receiver_id',
        'message',
        'read_at',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (ChatMessage $message) {
            if ($message->counseling_session_id && (! $message->konseli_id || ! $message->konselor_id)) {
                $session = CounselingSession::find($message->counseling_session_id);
                if ($session) {
                    $message->konseli_id = $message->konseli_id ?? $session->konseli_id;
                    $message->konselor_id = $message->konselor_id ?? $session->konselor_id;
                }
            }
        });
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(CounselingSession::class, 'counseling_session_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
