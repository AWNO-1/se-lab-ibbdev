<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        $user->loadCount(['posts', 'answers']);
        $posts = $user->posts()->withCount('answers')->latest()->paginate(6);
        $reputationLogs = $user->reputationLogs()->latest()->take(10)->get();

        return view('users.show', compact('user', 'posts', 'reputationLogs'));
    }

    public function index(Request $request)
    {
        $search = $request->query('search');
        $query = User::query()->withCount(['posts', 'answers']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderByDesc('reputation_points')->paginate(12)->withQueryString();

        return view('users.index', compact('users'));
    }
}
