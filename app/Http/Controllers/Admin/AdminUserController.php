<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get()->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'firstname' => $user->firstname,
                'lastname' => $user->lastname,
                'email' => $user->email,
                'is_admin' => $user->is_admin == 1,
                'registered_at' => $user->created_at ? $user->created_at->format('d/m/Y') : 'Inconnue',
                'last_login' => $user->date_derniere_connexion ? \Carbon\Carbon::parse($user->date_derniere_connexion)->format('d/m/Y H:i') : 'Jamais',
            ];
        });

        return Inertia::render('Admin_users', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', Password::defaults()],
            'is_admin' => 'boolean',
        ]);

        User::create([
            'username' => $validated['username'],
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => $validated['is_admin'] ?? false,
        ]);

        return back()->with('success', 'Utilisateur créé avec succès.');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => ['nullable', Password::defaults()],
            'is_admin' => 'boolean',
        ]);

        $user->username = $validated['username'];
        $user->firstname = $validated['firstname'];
        $user->lastname = $validated['lastname'];
        $user->email = $validated['email'];
        
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        // Prevent self-demotion
        if ($user->id !== Auth::id()) {
            $user->is_admin = $validated['is_admin'];
        }

        $user->save();

        return back()->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function toggleAdmin(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas retirer vos propres droits administrateur.');
        }

        $user->is_admin = $user->is_admin == 1 ? 0 : 1;
        $user->save();

        $action = $user->is_admin ? 'promu administrateur' : 'rétrogradé membre';
        return back()->with('success', "L'utilisateur {$user->username} a été {$action}.");
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
