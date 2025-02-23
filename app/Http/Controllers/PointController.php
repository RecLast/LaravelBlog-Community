<?php

namespace App\Http\Controllers;

use App\Models\Point;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $points = $user->points()->latest()->paginate(20);
        $achievements = $user->achievements;
        $totalPoints = $user->points()->sum('points');
        
        $nextAchievements = Achievement::whereDoesntHave('users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->where('points_required', '>', $totalPoints)
            ->orderBy('points_required')
            ->limit(3)
            ->get();

        return view('points.index', compact('points', 'achievements', 'totalPoints', 'nextAchievements'));
    }

    public static function awardPoints(User $user, int $points, string $actionType, int $actionId, string $description)
    {
        $point = Point::award($user, $points, $actionType, $actionId, $description);
        Achievement::checkAndAward($user);
        return $point;
    }

    public function leaderboard()
    {
        $users = User::withSum('points as total_points', 'points')
            ->orderByDesc('total_points')
            ->limit(50)
            ->get();

        return view('points.leaderboard', compact('users'));
    }
}