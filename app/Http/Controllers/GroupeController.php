<?php

namespace App\Http\Controllers;

use App\Models\Groupe;
use App\Models\UserGroupe;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class GroupeController extends Controller
{
    /**
     * Display the user's groups.
     */
    public function index()
    {
        $user = Auth::user();

        // Groups owned by the user
        $ownedGroups = Groupe::where('owner_users_id', $user->id)
            ->withCount('membres')
            ->get();

        // Groups joined by the user
        $joinedGroupsId = UserGroupe::where('users_id', $user->id)->pluck('groupe_id');
        $joinedGroups = Groupe::whereIn('id', $joinedGroupsId)
            ->with('owner')
            ->withCount('membres')
            ->get();

        return Inertia::render('Vitrine_my_groups', [
            'ownedGroups' => $ownedGroups,
            'joinedGroups' => $joinedGroups
        ]);
    }

    /**
     * Store a newly created group in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Groupe::create([
            'nom' => $request->nom,
            'owner_users_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Le groupe a été créé avec succès.');
    }

    /**
     * Update the specified group in storage.
     */
    public function update(Request $request, $id)
    {
        $group = Groupe::where('id', $id)->where('owner_users_id', Auth::id())->firstOrFail();

        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $group->update([
            'nom' => $request->nom,
        ]);

        return redirect()->back()->with('success', 'Le groupe a été modifié avec succès.');
    }

    /**
     * Remove the specified group from storage.
     */
    public function destroy($id)
    {
        $group = Groupe::where('id', $id)->where('owner_users_id', Auth::id())->firstOrFail();

        // Pivot cleanup
        UserGroupe::where('groupe_id', $id)->delete();
        $group->delete();

        return redirect()->back()->with('success', 'Le groupe a été supprimé.');
    }

    /**
     * Leave a joined group.
     */
    public function leave($id)
    {
        UserGroupe::where('users_id', Auth::id())->where('groupe_id', $id)->delete();

        return redirect()->back()->with('success', 'Vous avez quitté le groupe.');
    }
}
