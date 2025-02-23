<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'points_required',
        'badge_image',
        'type'
    ];

    protected $casts = [
        'points_required' => 'integer'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_achievements')
            ->withTimestamps();
    }

    public static function checkAndAward(User $user)
    {
        $userPoints = $user->points()->sum('points');
        
        $achievements = self::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('points_required', '<=', $userPoints)
            ->get();

        foreach ($achievements as $achievement) {
            $user->achievements()->attach($achievement->id);
        }

        return $achievements;
    }
}