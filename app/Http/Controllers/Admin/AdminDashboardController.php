<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aliment;
use App\Models\Groupe;
use App\Models\Recette;
use App\Models\User;
use App\Models\Avis;
use Inertia\Inertia;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_recipes' => Recette::count(),
            'total_groups' => Groupe::count(),
            'pending_ingredients' => Aliment::where('is_certified', false)->count(),
            'total_reviews' => Avis::count(),
        ];

        $recent_recipes = Recette::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $recent_users = User::orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return Inertia::render('Admin_dashboard', [
            'stats' => $stats,
            'recent_recipes' => $recent_recipes,
            'recent_users' => $recent_users,
        ]);
    }
}
