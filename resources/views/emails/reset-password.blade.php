<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Réinitialiser votre mot de passe — Family Recipe</title>
</head>
<body style="margin: 0; padding: 40px 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9fafb; color: #1f2937;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06);">
            <!-- Logo Section (White Background) -->
            <div style="background-color: #ffffff; padding: 32px; text-align: center; border-bottom: 1px solid #f3f4f6;">
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Family Recipe" style="width: 140px; height: auto;">
            </div>

            <!-- Header Section (Dark Background) -->
            <div style="background-color: #1f2937; background: linear-gradient(135deg, #1f2937 0%, #111827 100%); padding: 32px; text-align: center;">
                <h1 style="font-size: 22px; font-weight: 800; color: white; margin: 0;">Réinitialisation du mot de passe</h1>
                <p style="color: rgba(255,255,255,0.6); font-size: 14px; margin-top: 6px;">Vous avez demandé à changer votre mot de passe</p>
            </div>

            <!-- Content -->
            <div style="padding: 40px 32px;">
                <p style="font-size: 15px; color: #4b5563; line-height: 1.7; margin-bottom: 20px;">
                    Bonjour,<br><br>
                    Nous avons reçu une demande de réinitialisation de mot de passe pour le compte associé à cette adresse e-mail.
                    Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe :
                </p>

                <div style="text-align: center; margin-bottom: 28px;">
                    <a href="{{ $url }}" style="display: inline-block; background-color: #059669; color: #ffffff !important; font-weight: 700; font-size: 16px; padding: 16px 40px; text-decoration: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);">Réinitialiser mon mot de passe</a>
                </div>

                <div style="background: #fef9c3; border: 1px solid #fde68a; border-radius: 10px; padding: 14px 18px; margin-bottom: 28px; font-size: 13px; color: #92400e;">
                    ⏰ &nbsp;<span>Ce lien est valable pendant <strong>60 minutes</strong> uniquement. Passé ce délai, vous devrez faire une nouvelle demande.</span>
                </div>

                <p style="font-size: 14px; color: #9ca3af; margin-bottom: 10px;">
                    Si vous ne parvenez pas à cliquer sur le bouton, copiez et collez ce lien dans votre navigateur :
                </p>
                <div style="background: #f3f4f6; border-radius: 8px; padding: 14px; font-size: 12px; color: #6b7280; word-break: break-all; margin-bottom: 28px;">
                    <a href="{{ $url }}" style="color: #059669;">{{ $url }}</a>
                </div>

                <p style="font-size: 14px; color: #9ca3af; margin-bottom: 0;">
                    Si vous n'avez pas demandé à réinitialiser votre mot de passe, ignorez cet e-mail.
                    Votre mot de passe restera inchangé.
                </p>
            </div>

            <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 0;">
            <div style="padding: 24px 32px; text-align: center; font-size: 13px; color: #9ca3af; line-height: 1.6;">
                <p>Cet e-mail a été envoyé automatiquement par Family Recipe.<br>
                Pour toute question, <a href="mailto:{{ config('mail.from.address') }}" style="color: #059669; text-decoration: none;">contactez notre support</a>.</p>
                <p style="margin-top: 10px; color: #9ca3af;">&copy; {{ date('Y') }} Family Recipe. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</body>
</html>
