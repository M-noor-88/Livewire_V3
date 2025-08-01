<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'user_id', 'title', 'description', 'status', 'due_date'
    ];

    // Owner
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scope for current user's tasks
    public function scopeOwnedBy($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
