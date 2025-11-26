<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Catégories</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

<div class="w-full max-w-4xl p-8 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl shadow-2xl">

    <h1 class="text-2xl font-bold text-white mb-6 text-center">Gestion des Catégories</h1>

    <!-- Ajout d'une nouvelle catégorie -->
    <div class="bg-white/10 backdrop-blur-sm border border-white/30 shadow-md rounded-xl p-6 mb-8">
        <h2 class="text-xl font-semibold text-white mb-4">Ajouter une catégorie</h2>
        <form action="index.php?action=add_category" method="POST" class="flex gap-4">
            <input type="text" name="name" placeholder="Nom de la catégorie" required
                   class="flex-1 rounded-md border border-white/30 bg-white/10 text-white placeholder-white/70 shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500">
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600/70 hover:bg-indigo-700/70 text-white font-medium rounded-md transition duration-150">
                Ajouter
            </button>
        </form>
    </div>

    <!-- Liste des catégories -->
    <div class="bg-white/10 backdrop-blur-sm border border-white/30 shadow-md rounded-xl p-6">
        <h2 class="text-xl font-semibold text-white mb-4">Liste des catégories</h2>
        <table class="min-w-full divide-y divide-white/30">
            <thead class="bg-white/20">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-white/30">
            <?php if (empty($categories)): ?>
                <tr>
                    <td colspan="2" class="px-6 py-4 text-center text-sm text-white/70">
                        Aucune catégorie trouvée.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td class="px-6 py-4 text-sm text-white"><?= htmlspecialchars($cat['name']) ?></td>
                        <td class="px-6 py-4 text-right text-sm space-x-2">
                            <form method="POST" action="index.php?action=modify_category" class="inline-flex gap-2">
                                <input type="hidden" name="idCategory" value="<?= $cat['idCategory'] ?>">
                                <input type="text" name="name" value="<?= htmlspecialchars($cat['name']) ?>" required
                                       class="border border-white/30 bg-white/10 text-white px-2 rounded-md">
                                <button type="submit" class="bg-yellow-400/70 hover:bg-yellow-500/70 px-2 rounded-md text-white">Modifier</button>
                            </form>
                            <a href="index.php?action=delete_category&id=<?= $cat['idCategory'] ?>"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer la catégorie <?= htmlspecialchars(addslashes($cat['name'])) ?> ?')"
                               class="text-red-500 hover:text-red-700">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <a href="index.php?action=tasks" class="block mt-6 text-center text-white/80 hover:text-white text-sm">
        ← Retour à la liste des tâches
    </a>
</div>

</body>
</html>
