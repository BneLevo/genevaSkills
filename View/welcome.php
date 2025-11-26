<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bienvenue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

<div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl shadow-2xl p-10 w-full max-w-md text-center">
    <h1 class="text-3xl font-bold text-white mb-4">Bienvenue 👋</h1>
    <p class="text-white/80 mb-6">
        Crée ton compte pour gérer facilement toutes tes tâches.
    </p>

    <div class="space-y-4">
        <a href="index.php?action=sign_up"
           class="block w-full bg-white/20 backdrop-blur-md text-white hover:bg-white/30 py-2 rounded-md transition">
            Créer un compte
        </a>

        <a href="index.php?action=login"
           class="block w-full border border-white/30 text-white hover:bg-white/10 py-2 rounded-md transition">
            Se connecter
        </a>
    </div>
</div>

</body>
</html>
