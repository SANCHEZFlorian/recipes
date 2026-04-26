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

        // Dissociate all recipes from this group before deleting
        \App\Models\Recette::where('groupe_id', $id)->update(['groupe_id' => null]);

        // Pivot cleanup
        UserGroupe::where('groupe_id', $id)->delete();
        $group->delete();

        return redirect()->back()->with('success', 'Le groupe a été supprimé.');
    }

    /**
     * Display a specific group with its recipes and members.
     */
    public function show($id)
    {
        $group = Groupe::with(['owner', 'membres'])->findOrFail($id);

        // Security: only owner or member can view this group
        $isOwner = $group->owner_users_id === Auth::id();
        $isMember = $group->membres->contains(Auth::id());

        if (!$isOwner && !$isMember && !optional(Auth::user())->is_admin) {
            abort(403, 'Accès non autorisé.');
        }

        // Load recipes associated with this group
        $recettes = \App\Models\Recette::with(['user', 'RecetteType', 'prix', 'difficulte', 'recettePhotos.photo'])
            ->where('groupe_id', $group->id)
            ->where('is_supprimer', false)
            ->latest()
            ->get();

        // Also get pending invitations if user is owner
        $invitations = $isOwner ? \App\Models\GroupInvitation::where('groupe_id', $group->id)->get() : [];

        return Inertia::render('Vitrine_group_show', [
            'group' => $group,
            'recipes' => $recettes,
            'isOwner' => $isOwner,
            'invitations' => $invitations
        ]);
    }

    /**
     * Add member or send invitation.
     */
    public function addMember(Request $request, $id)
    {
        $group = Groupe::with('membres')->where('id', $id)->where('owner_users_id', Auth::id())->firstOrFail();

        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $email = $request->email;
        $user = \App\Models\User::where('email', $email)->first();

        // If trying to add oneself
        if ($user && $user->id === Auth::id()) {
            return back()->withErrors(['email' => 'Vous ne pouvez pas vous inviter vous-même.']);
        }

        if ($user) {
            // Check if already member
            if ($group->membres->contains($user->id)) {
                return back()->withErrors(['email' => 'Cet utilisateur est déjà membre.']);
            }
            // Add user directly
            UserGroupe::create([
                'groupe_id' => $group->id,
                'users_id' => $user->id
            ]);
            return back()->with('success', 'Utilisateur ajouté au groupe.');
        } else {
            // Check if already invited
            if (\App\Models\GroupInvitation::where('groupe_id', $group->id)->where('email', $email)->exists()) {
                 return back()->withErrors(['email' => 'Une invitation a déjà été envoyée à cette adresse.']);
            }

            // Create invitation
            \App\Models\GroupInvitation::create([
                'groupe_id' => $group->id,
                'email' => $email
            ]);

            // Send Email
            \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\GroupInvitationMail($group, $email));

            return back()->with('success', 'Invitation envoyée par email à '.$email.'.');
        }
    }

    /**
     * Remove member.
     */
    public function removeMember($id, $userId)
    {
        $group = Groupe::where('id', $id)->where('owner_users_id', Auth::id())->firstOrFail();
        
        UserGroupe::where('groupe_id', $group->id)->where('users_id', $userId)->delete();
        
        return back()->with('success', 'Membre retiré du groupe.');
    }

    /**
     * Revoke invitation.
     */
    public function revokeInvitation($id, $invitationId)
    {
        $group = Groupe::where('id', $id)->where('owner_users_id', Auth::id())->firstOrFail();
        
        \App\Models\GroupInvitation::where('groupe_id', $group->id)->where('id', $invitationId)->delete();
        
        return back()->with('success', 'Invitation annulée.');
    }

    /**
     * Leave a joined group.
     */
    public function leave($id)
    {
        UserGroupe::where('users_id', Auth::id())->where('groupe_id', $id)->delete();

        return redirect()->route('groups')->with('success', 'Vous avez quitté le groupe.');
    }
}
