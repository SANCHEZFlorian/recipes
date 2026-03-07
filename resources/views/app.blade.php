<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title inertia>Recipes</title>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Flaticon UICons -->
        <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.1.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>

        @vite(['resources/js/app.js', 'resources/css/app.css'])
        @routes
        @inertiaHead
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        @inertia
    </body>
</html>
