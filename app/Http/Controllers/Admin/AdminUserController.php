<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'is_admin' => $user->is_admin == 1, // Cast to boolean for easy frontend handling
                'registered_at' => $user->created_at ? $user->created_at->format('d/m/Y') : 'Inconnue',
                'last_login' => $user->date_derniere_connexion ? \Carbon\Carbon::parse($user->date_derniere_connexion)->format('d/m/Y H:i') : 'Jamais',
            ];
        });

        return Inertia::render('Admin_users', [
            'users' => $users
        ]);
    }

    public function toggleAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Prevent self-demotion
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas retirer vos propres droits administrateur.');
        }

        // Toggle admin status
        $user->is_admin = $user->is_admin == 1 ? 0 : 1;
        $user->save();

        $action = $user->is_admin ? 'promu administrateur' : 'rétrogradé membre';
        return back()->with('success', "L'utilisateur {$user->username} a été {$action}.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Prevent self-deletion
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
