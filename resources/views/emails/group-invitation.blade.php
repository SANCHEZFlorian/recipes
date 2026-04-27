<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Invitation à rejoindre un groupe</title>
</head>
<body style="margin: 0; padding: 40px 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f3f4f6; color: #374151;">
    <div style="max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <!-- Logo Section (White Background) -->
        <div style="background-color: #ffffff; padding: 24px; text-align: center; border-bottom: 1px solid #f3f4f6;">
            <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Family Recipe" style="width: 140px; height: auto;">
        </div>

        <!-- Header Section -->
        <div style="background-color: #059669; padding: 30px 20px; text-align: center; color: white;">
            <h1 style="margin: 0; font-size: 24px;">Cuisinons ensemble ! 🍳</h1>
        </div>

        <!-- Content -->
        <div style="padding: 40px 30px; text-align: center; line-height: 1.6;">
            <h2 style="margin-top: 0; color: #111827;">Vous avez reçu une invitation</h2>
            <p style="font-size: 16px; color: #4b5563;">
                <strong>{{ $group->owner->username }}</strong> souhaite partager ses recettes avec vous en vous invitant à rejoindre le groupe <strong>"{{ $group->nom }}"</strong> sur Family Recipe.
            </p>
            
            <p style="font-size: 15px; color: #6b7280; margin-top: 20px;">
                Pour accepter l'invitation et découvrir les délices qui vous attendent, veuillez créer votre compte en cliquant sur le bouton ci-dessous :
            </p>
            
            <div style="margin-top: 30px;">
                <a href="{{ url('/') }}?register=1&email={{ urlencode($invitedEmail) }}" style="display: inline-block; background-color: #059669; color: #ffffff !important; font-weight: bold; padding: 14px 28px; text-decoration: none; border-radius: 8px;">Créer mon compte</a>
            </div>
            
            <p style="margin-top: 40px; font-size: 14px; color: #9ca3af;">
                Si vous n'êtes pas concerné, ignorez simplement cet e-mail.
            </p>
        </div>

        <!-- Footer -->
        <div style="padding: 24px 20px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #f3f4f6;">
            <p style="margin: 0;">&copy; {{ date('Y') }} Family Recipe. Tous droits réservés.</p>
        </div>
    </div>
</body>
</html>
