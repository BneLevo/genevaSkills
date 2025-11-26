<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md p-8 space-y-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl shadow-2xl">

    <!-- Titre -->
    <div class="text-center">
        <h2 class="text-3xl font-extrabold text-white">
            Créez votre compte
        </h2>
        <p class="mt-2 text-sm text-white/80">
            Inscrivez-vous pour commencer à gérer vos tâches.
        </p>
    </div>

    <!-- FORMULAIRE -->
    <form class="space-y-6" method="POST" action="index.php?action=sign_up">
        <div>
            <label for="email" class="block text-sm font-medium text-white">Adresse Email</label>
            <input id="email" name="email" type="email" required
                   class="mt-1 block w-full px-3 py-2 border border-white/30 rounded-md bg-white/10 text-white placeholder-white/60 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-white">Mot de passe</label>
            <input id="password" name="password" type="password" required
                   class="mt-1 block w-full px-3 py-2 border border-white/30 rounded-md bg-white/10 text-white placeholder-white/60 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <div>
            <label for="confirm-password" class="block text-sm font-medium text-white">Confirmer le mot de passe</label>
            <input id="confirm-password" name="passwordCheck" type="password" required
                   class="mt-1 block w-full px-3 py-2 border border-white/30 rounded-md bg-white/10 text-white placeholder-white/60 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>

        <button type="submit"
                class="w-full py-2 px-4 rounded-md bg-indigo-600/70 hover:bg-indigo-700/70 text-white font-medium shadow-md focus:ring-2 focus:ring-indigo-500 transition">
            S'inscrire
        </button>
    </form>

    <!-- Lien connexion -->
    <div class="text-center text-sm text-white/80">
        Déjà un compte ?
        <a href="index.php?action=login"
           class="font-medium text-white hover:text-indigo-200">
            Connectez-vous ici
        </a>
    </div>

    <!-- Erreurs -->
    <?php if (!empty($errors)): ?>
        <div class="p-4 text-sm text-red-700 bg-red-100/30 rounded-lg mt-4">
            <p class="font-bold">Erreur(s) d'inscription :</p>
            <ul class="mt-2 list-disc list-inside">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
