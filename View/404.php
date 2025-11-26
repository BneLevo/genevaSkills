<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur 404 - Page Non Trouvée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 flex items-center justify-center min-h-screen">

<div class="bg-white/20 backdrop-blur-md border border-white/30 p-10 md:p-16 rounded-2xl shadow-2xl max-w-lg w-full text-center transform transition duration-300 hover:scale-[1.01]">

    <div class="text-6xl font-extrabold text-red-500 mb-2 sm:text-7xl">
        404
    </div>

    <h1 class="text-2xl font-bold text-white mb-3 sm:text-3xl">
        Page Non Trouvée
    </h1>

    <p class="text-base text-white/80 mb-8">
        Désolé, la page que vous cherchez n'existe pas, a été déplacée ou l'adresse est incorrecte.
    </p>

    <a href="index.php?action=login" class="inline-block py-3 px-6 bg-indigo-600/70 text-white font-semibold
                           rounded-xl shadow-lg hover:bg-indigo-700/70 active:bg-indigo-800/70
                           transition duration-150 transform hover:scale-[1.05]">
        Retourner à la page de connexion
    </a>
</div>

</body>
</html>
