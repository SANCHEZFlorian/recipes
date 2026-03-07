<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unite;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminMeasurementController extends Controller
{
    public function index()
    {
        $measurements = Unite::orderBy('nom')->get()->map(function ($unit) {
            return [
                'id' => $unit->id,
                'name' => $unit->nom,
                'abbreviation' => $unit->abreviation,
                'icon' => $unit->icone ?? 'fas fa-balance-scale',
            ];
        });

        return Inertia::render('Admin_measurement', [
            'measurements' => $measurements
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:unite,nom',
            'abreviation' => 'required|string|max:50',
            'icone' => 'nullable|string|max:100',
        ]);

        Unite::create($validated);

        return back()->with('success', 'Unité de mesure créée avec succès.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:unite,nom,' . $id,
            'abreviation' => 'required|string|max:50',
            'icone' => 'nullable|string|max:100',
        ]);

        $unit = Unite::findOrFail($id);
        $unit->update($validated);

        return back()->with('success', 'Unité de mesure mise à jour.');
    }

    public function destroy($id)
    {
        $unit = Unite::findOrFail($id);
        
        // In a real scenario, we might want to check if the unit is used in any recipes
        // However, the database schema doesn't seem to have a direct relation from Unite to RecetteIngredient yet
        // If it does, we should check it here before deleting. For now, we allow deletion.

        $unit->delete();

        return back()->with('success', 'Unité de mesure supprimée.');
    }
}
