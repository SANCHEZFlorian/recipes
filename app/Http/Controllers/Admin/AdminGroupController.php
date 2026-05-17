<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Groupe;
use Inertia\Inertia;

class AdminGroupController extends Controller
{
    public function index()
    {
        $groups = Groupe::withCount('membres')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return Inertia::render('Admin_groups', [
            'groups' => $groups
        ]);
    }

    public function destroy($id)
    {
        $group = Groupe::findOrFail($id);
        
        // Supprimer les relations pivot avant de supprimer le groupe
        $group->membres()->detach();
        $group->delete();

        return redirect()->back()->with('success', 'Le groupe a été supprimé avec succès.');
    }
}
