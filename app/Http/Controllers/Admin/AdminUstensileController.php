<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ustensile;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminUstensileController extends Controller
{
    public function index()
    {
        $ustensiles = Ustensile::orderBy('nom')->get();

        return Inertia::render('Admin_ustensiles', [
            'ustensiles' => $ustensiles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:255',
        ]);

        Ustensile::create($validated);

        return redirect()->back()->with('success', 'Ustensile ajouté avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string|max:255',
        ]);

        $ustensile = Ustensile::findOrFail($id);
        $ustensile->update($validated);

        return redirect()->back()->with('success', 'Ustensile mis à jour.');
    }

    public function destroy($id)
    {
        $ustensile = Ustensile::findOrFail($id);
        
        if ($ustensile->recetteUstensiles()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer cet ustensile car il est utilisé dans des recettes.');
        }

        $ustensile->delete();

        return redirect()->back()->with('success', 'Ustensile supprimé.');
    }
}
