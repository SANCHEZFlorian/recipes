<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Inertia\Inertia;

class PasswordResetController extends Controller
{
    /**
     * Display the forgot password form.
     */
    public function showForgotForm()
    {
        return Inertia::render('ForgotPassword');
    }

    /**
     * Send a password reset link to the given email.
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email'    => 'Veuillez entrer une adresse e-mail valide.',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'Un lien de réinitialisation a été envoyé à votre adresse e-mail.');
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }

    /**
     * Display the password reset form.
     */
    public function showResetForm(Request $request, string $token)
    {
        return Inertia::render('ResetPassword', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    /**
     * Handle the password reset.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'                 => ['required'],
            'email'                 => ['required', 'email'],
            'password'              => ['required', 'min:8', 'confirmed'],
        ], [
            'token.required'              => 'Le jeton de réinitialisation est manquant.',
            'email.required'              => 'L\'adresse e-mail est obligatoire.',
            'email.email'                 => 'Veuillez entrer une adresse e-mail valide.',
            'password.required'           => 'Le mot de passe est obligatoire.',
            'password.min'                => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed'          => 'Les mots de passe ne correspondent pas.',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password'       => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('home', ['login' => 1])
                ->with('status', 'Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter.');
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }
}
