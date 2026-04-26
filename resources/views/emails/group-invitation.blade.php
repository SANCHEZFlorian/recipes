<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invitation à rejoindre un groupe</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; padding: 20px; color: #374151; }
        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .header { background-color: #059669; padding: 30px 20px; text-align: center; color: white; }
        .header h1 { margin: 0; font-size: 24px; }
        .content { padding: 30px; text-align: center; line-height: 1.6; }
        .button { display: inline-block; background-color: #059669; color: white !important; font-weight: bold; padding: 14px 28px; text-decoration: none; border-radius: 8px; margin-top: 20px; }
        .footer { padding: 20px; text-align: center; font-size: 12px; color: #6b7280; border-top: 1px solid #f3f4f6; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Cuisinons ensemble ! 🍳</h1>
        </div>
        <div class="content">
            <h2>Vous avez reçu une invitation</h2>
            <p><strong>{{ $group->owner->username }}</strong> souhaite partager ses recettes avec vous en vous invitant à rejoindre le groupe <strong>"{{ $group->nom }}"</strong>.</p>
            
            <p>Pour accepter l'invitation et découvrir les délices qui vous attendent, veuillez créer votre compte en cliquant sur le bouton ci-dessous :</p>
            
            <a href="{{ url('/') }}?register=1&email={{ urlencode($invitedEmail) }}" class="button">Créer mon compte</a>
            
            <p style="margin-top: 30px; font-size: 14px; color: #9ca3af;">Si vous n'êtes pas concerné, ignorez simplement cet e-mail.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Recipes App. Tous droits réservés.
        </div>
    </div>
</body>
</html>
