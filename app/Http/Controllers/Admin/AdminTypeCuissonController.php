<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeCuisson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminTypeCuissonController extends Controller
{
    public function index()
    {
        $types = TypeCuisson::orderBy('id', 'desc')->get();

        return Inertia::render('Admin_cooking_type', [
            'types' => $types,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string'
        ]);

        TypeCuisson::create($validated);

        return back()->with('success', 'Type de cuisson créé.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'icone' => 'nullable|string'
        ]);

        TypeCuisson::findOrFail($id)->update($validated);

        return back()->with('success', 'Type de cuisson mis à jour.');
    }

    public function destroy($id)
    {
        try {
            TypeCuisson::findOrFail($id)->delete();
            return back()->with('success', 'Type de cuisson supprimé.');
        } catch (\Exception $e) {
            return back()->with('error', 'Impossible de supprimer ce type de cuisson car il est utilisé.');
        }
    }
}
