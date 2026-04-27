<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Family Recipe — Découvrez et partagez des milliers de recettes savoureuses. Trouvez l'inspiration pour vos repas quotidiens grâce à notre communauté de passionnés de cuisine.">
        <meta name="theme-color" content="#059669">
        <meta name="author" content="Family Recipe">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">

        {{-- Open Graph --}}
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Family Recipe">
        <meta property="og:locale" content="fr_FR">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">

        {{-- Twitter Card --}}
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@FamilyRecipe">
        <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

        <title inertia>Family Recipe</title>

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="/favicon.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon.png">

        {{-- Google Fonts: Inter --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Flaticon UICons -->
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        {{-- JSON-LD Structured Data --}}
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Family Recipe",
            "url": "{{ config('app.url') }}",
            "description": "Découvrez et partagez des milliers de recettes savoureuses avec la communauté Family Recipe.",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "{{ config('app.url') }}/?search={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
        </script>

        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @routes
        @inertiaHead
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50" style="font-family: 'Inter', system-ui, -apple-system, sans-serif;">
        @inertia
    </body>
</html>
