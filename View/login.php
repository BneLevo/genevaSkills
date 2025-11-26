<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md p-8 space-y-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl shadow-2xl">

    <!-- Titre -->
    <div class="text-center">
        <h2 class="text-3xl font-extrabold text-white">
            Bienvenue !
        </h2>
        <p class="mt-2 text-sm text-white/80">
            Connectez-vous pour accéder à vos tâches.
        </p>
    </div>

    <!-- FORMULAIRE -->
    <form class="space-y-6" method="POST">

        <div>
            <label for="email" class="block text-sm font-medium text-white">Adresse Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required
                   class="mt-1 block w-full px-3 py-2 border border-white/30 rounded-md bg-white/10 text-white placeholder-white/60 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-white">Mot de passe</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required
                   class="mt-1 block w-full px-3 py-2 border border-white/30 rounded-md bg-white/10 text-white placeholder-white/60 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <button type="submit"
                    class="w-full py-2 px-4 rounded-md bg-indigo-600/70 hover:bg-indigo-700/70 text-white font-medium shadow-md focus:ring-2 focus:ring-indigo-500 transition">
                Se connecter
            </button>
        </div>
    </form>

    <!-- Lien inscription -->
    <div class="text-center text-sm text-white/80">
        Pas encore de compte ?
        <a href="index.php?action=sign_up" class="font-medium text-white hover:text-indigo-200">
            Inscrivez-vous ici
        </a>
    </div>

    <!-- ERROR MESSAGES -->
    <?php if (!empty($errors)): ?>
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100/30 rounded-lg">
            <p class="font-bold">Erreur(s) :</p>
            <ul class="mt-1.5 list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
