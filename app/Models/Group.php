<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'owner_id',
        'privacy',
        'member_count',
        'is_active'
    ];

    protected static function booted()
    {
        static::created(function ($group) {
            // Add owner as admin member
            $group->users()->attach($group->owner_id, [
                'role' => 'admin',
                'joined_at' => now()
            ]);
            
            // Increment member count
            $group->increment('member_count');
        });
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function user()
    {
        return $this->owner();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->withPivot('role', 'joined_at')
                    ->withTimestamps();
    }

    public function members()
    {
        return $this->users();
    }
}