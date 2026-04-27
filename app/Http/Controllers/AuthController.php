<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Les identifiants fournis ne correspondent pas à nos enregistrements.',
        ])->onlyInput('email');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    /**
     * Handle a registration request for the application.
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = \App\Models\User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Process any pending group invitations for this email
        $invitations = \App\Models\GroupInvitation::where('email', $user->email)->get();
        foreach ($invitations as $invitation) {
            \App\Models\UserGroupe::create([
                'groupe_id' => $invitation->groupe_id,
                'users_id' => $user->id
            ]);
            $invitation->delete();
        }

        Auth::login($user);

        // Send welcome email (queued-friendly — won't block the response)
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
        } catch (\Exception $e) {
            // Ne pas bloquer l'inscription si l'envoi d'e-mail échoue
            \Illuminate\Support\Facades\Log::warning('Welcome email failed: ' . $e->getMessage());
        }

        return redirect()->intended();
    }
}
