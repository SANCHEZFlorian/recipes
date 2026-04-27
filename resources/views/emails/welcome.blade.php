<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bienvenue sur Family Recipe 🍳</title>
</head>
<body style="margin: 0; padding: 40px 20px; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f0fdf4; color: #1f2937;">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(5, 150, 105, 0.08);">
            <!-- Logo Section (White Background) -->
            <div style="background-color: #ffffff; padding: 32px; text-align: center; border-bottom: 1px solid #f0fdf4;">
                <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Family Recipe" style="width: 140px; height: auto;">
            </div>

            <!-- Header Section (Green Background) -->
            <div style="background-color: #059669; background: linear-gradient(135deg, #059669 0%, #047857 100%); padding: 32px; text-align: center;">
                <h1 style="font-size: 26px; font-weight: 800; color: white; margin: 0;">Bienvenue dans la communauté !</h1>
                <p style="color: rgba(255,255,255,0.8); font-size: 15px; margin-top: 6px;">Votre compte a été créé avec succès.</p>
            </div>

            <!-- Content -->
            <div style="padding: 40px 32px;">
                <p style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 16px;">Bonjour {{ $user->username }} 👋</p>
                <p style="font-size: 15px; color: #6b7280; line-height: 1.7; margin-bottom: 24px;">
                    Nous sommes ravis de vous accueillir sur <strong>Family Recipe</strong>, la plateforme où les passionnés de cuisine
                    partagent leurs meilleures recettes. Votre compte est désormais actif et prêt à l'emploi !
                </p>

                <div style="background: #f9fafb; border-radius: 12px; padding: 24px; margin-bottom: 32px;">
                    <h3 style="font-size: 14px; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 16px;">Ce que vous pouvez faire :</h3>
                    
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding-bottom: 14px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="44" valign="top">
                                            <div style="width: 32px; height: 32px; background: #d1fae5; border-radius: 8px; text-align: center; line-height: 32px; font-size: 16px;">📖</div>
                                        </td>
                                        <td valign="top">
                                            <strong style="display: block; font-size: 14px; font-weight: 600; color: #111827;">Explorer des milliers de recettes</strong>
                                            <span style="font-size: 13px; color: #9ca3af;">Filtrez par catégorie, difficulté ou temps de préparation</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 14px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="44" valign="top">
                                            <div style="width: 32px; height: 32px; background: #d1fae5; border-radius: 8px; text-align: center; line-height: 32px; font-size: 16px;">❤️</div>
                                        </td>
                                        <td valign="top">
                                            <strong style="display: block; font-size: 14px; font-weight: 600; color: #111827;">Sauvegarder vos favoris</strong>
                                            <span style="font-size: 13px; color: #9ca3af;">Retrouvez facilement les recettes qui vous inspirent</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 14px;">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="44" valign="top">
                                            <div style="width: 32px; height: 32px; background: #d1fae5; border-radius: 8px; text-align: center; line-height: 32px; font-size: 16px;">✍️</div>
                                        </td>
                                        <td valign="top">
                                            <strong style="display: block; font-size: 14px; font-weight: 600; color: #111827;">Partager vos créations</strong>
                                            <span style="font-size: 13px; color: #9ca3af;">Publiez vos recettes et recevez des avis de la communauté</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td width="44" valign="top">
                                            <div style="width: 32px; height: 32px; background: #d1fae5; border-radius: 8px; text-align: center; line-height: 32px; font-size: 16px;">👥</div>
                                        </td>
                                        <td valign="top">
                                            <strong style="display: block; font-size: 14px; font-weight: 600; color: #111827;">Rejoindre des groupes</strong>
                                            <span style="font-size: 13px; color: #9ca3af;">Cuisinez en communauté avec vos amis et votre famille</span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="text-align: center; margin-bottom: 32px;">
                    <a href="{{ url('/') }}" style="display: inline-block; background-color: #059669; background: linear-gradient(135deg, #059669 0%, #047857 100%); color: #ffffff !important; font-weight: 700; font-size: 16px; padding: 16px 40px; text-decoration: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);">Découvrir les recettes →</a>
                </div>
            </div>

            <hr style="border: none; border-top: 1px solid #f3f4f6; margin: 0;">
            <div style="padding: 24px 32px; text-align: center;">
                <p style="font-size: 13px; color: #9ca3af; line-height: 1.6;">Vous recevez cet e-mail car vous venez de créer un compte sur Family Recipe.<br>
                Si vous n'êtes pas à l'origine de cette inscription, <a href="mailto:{{ config('mail.from.address') }}" style="color: #059669; text-decoration: none;">contactez-nous</a>.</p>
                <p style="margin-top: 12px; font-size: 13px; color: #9ca3af;">&copy; {{ date('Y') }} Family Recipe. Tous droits réservés.</p>
            </div>
        </div>
    </div>
</body>
</html>
