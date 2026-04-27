<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Groupe;
use App\Mail\WelcomeMail;
use App\Mail\GroupInvitationMail;
use Illuminate\Http\Request;

class MailPreviewController extends Controller
{
    public function index()
    {
        $links = [
            ['name' => 'Bienvenue (Welcome Mail)', 'url' => route('mail-previews.welcome')],
            ['name' => 'Invitation Groupe', 'url' => route('mail-previews.invitation')],
            ['name' => 'Réinitialisation Mot de passe', 'url' => route('mail-previews.reset')],
        ];

        return "
            <html>
                <head>
                    <title>Prévisualisation des Mails</title>
                    <style>
                        body { font-family: sans-serif; padding: 40px; background: #f8fafc; color: #1e293b; }
                        h1 { color: #059669; }
                        ul { list-style: none; padding: 0; }
                        li { margin-bottom: 10px; }
                        a { 
                            display: block; 
                            padding: 15px; 
                            background: white; 
                            border-radius: 8px; 
                            text-decoration: none; 
                            color: #334155; 
                            border: 1px solid #e2e8f0;
                            transition: all 0.2s;
                        }
                        a:hover { 
                            border-color: #10b981; 
                            transform: translateX(5px);
                            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
                        }
                    </style>
                </head>
                <body>
                    <h1>📬 Test des Emails - Family Recipe</h1>
                    <p>Cliquez sur un lien pour voir le rendu du mail.</p>
                    <ul>" . implode('', array_map(fn($l) => "<li><a href='{$l['url']}'>{$l['name']}</a></li>", $links)) . "</ul>
                </body>
            </html>
        ";
    }

    public function welcome()
    {
        $user = User::first() ?? new User(['username' => 'TestUser', 'email' => 'test@example.com']);
        return new WelcomeMail($user);
    }

    public function invitation()
    {
        $group = Groupe::first() ?? new Groupe(['nom' => 'Le Clan des Gourmands']);
        return new GroupInvitationMail($group, 'invite@example.com');
    }

    public function reset()
    {
        return new \App\Mail\PreviewResetPasswordMail('https://family-recipe.test/reset-password/fake-token?email=test@example.com');
    }
}
