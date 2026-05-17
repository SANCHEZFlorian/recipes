<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prix;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminPriceController extends Controller
{
    public function index()
    {
        $prices = Prix::all();

        return Inertia::render('Admin_price', [
            'prices' => $prices
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Prix::create([
            ...$validated,
            'icone' => 'fas fa-euro-sign',
        ]);

        return redirect()->back()->with('success', 'Niveau de prix ajouté.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $price = Prix::findOrFail($id);
        $price->update($validated);

        return redirect()->back()->with('success', 'Niveau de prix mis à jour.');
    }

    public function destroy($id)
    {
        $price = Prix::findOrFail($id);
        
        if ($price->recettes()->count() > 0) {
            return redirect()->back()->with('error', 'Impossible de supprimer ce niveau de prix car il est lié à des recettes.');
        }

        $price->delete();

        return redirect()->back()->with('success', 'Niveau de prix supprimé.');
    }
}
