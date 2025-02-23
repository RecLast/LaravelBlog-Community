<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'points',
        'action_type',
        'action_id',
        'description'
    ];

    protected $casts = [
        'points' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function award(User $user, int $points, string $actionType, int $actionId, string $description)
    {
        return self::create([
            'user_id' => $user->id,
            'points' => $points,
            'action_type' => $actionType,
            'action_id' => $actionId,
            'description' => $description
        ]);
    }
}