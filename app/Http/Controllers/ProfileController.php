<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        // Load the relationship to get accurate stats
        $user->loadCount(['recettes', 'favoris', 'avis']);

        // We'll calculate a mockup rating or total views as they are not explicitly detailed in the models
        // but we have 'recettes.commentaires' and 'recettes' for the views.
        // For simplicity, we just pass what we can readily calculate or mock the rest for presentation.

        $recipes = $user->recettes()->with(['photo', 'difficulte', 'prix'])->latest()->take(6)->get();

        return Inertia::render('Vitrine_profile', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'username' => $user->username,
                'email' => $user->email,
                'location' => $user->city . ($user->country ? ', ' . $user->country : ''),
                'joinDate' => $user->created_at ? $user->created_at->format('F Y') : 'Unknown',
                'lastActive' => $user->date_derniere_connexion ? \Carbon\Carbon::parse($user->date_derniere_connexion)->diffForHumans() : 'Recently',
                'bio' => $user->about ?? 'Aucune biographie renseignée.',
                'avatar' => $user->photo?->url ?? "https://ui-avatars.com/api/?name=" . urlencode($user->username) . "&background= random&color=fff",
                'coverImage' => "https://images.unsplash.com/photo-1495195134817-aeb325a55b65?q=80&w=2076&auto=format&fit=crop", // Placeholder cover
                'stats' => [
                    'recipes' => $user->recettes_count,
                    'reviews' => $user->avis_count,
                    'favorites' => $user->favoris_count,
                    'avgRating' => 4.5, // Mock data
                    'views' => rand(100, 10000), // Mock data
                    'followers' => rand(0, 100), // Mock data
                    'following' => rand(0, 100), // Mock data
                ]
            ],
            'recentRecipes' => $recipes,
            'recentActivity' => [
                // Mock activity data
                [
                    'icon' => 'fa-plus',
                    'text' => 'A rejoint CookBook',
                    'time' => $user->created_at ? $user->created_at->diffForHumans() : 'Récemment'
                ]
            ]
        ]);
    }
}
