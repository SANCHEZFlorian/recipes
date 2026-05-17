<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Difficulte;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminDifficultyController extends Controller
{
    public function index()
    {
        $difficulties = Difficulte::all();

        return Inertia::render('Admin_difficulty', [
            'difficulties' => $difficulties
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Difficulte::create([
            ...$validated,
            'icone' => 'fas fa-signal',
        ]);

        return redirect()->back()->with('success', 'Niveau de difficulté ajouté.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $difficulty = Difficulte::findOrFail($id);
        $difficulty->update($validated);

        return redirect()->back()->with('success', 'Niveau de difficulté mis à jour.');
    }

    public function destroy($id)
    {
        $difficulty = Difficulte::findOrFail($id);
        
        if ($difficulty->recettes()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cette difficulté car elle est liée à des recettes.');
        }

        $difficulty->delete();

        return redirect()->back()->with('success', 'Difficulté supprimée.');
    }
}
