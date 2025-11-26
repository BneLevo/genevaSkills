<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen">

<header class="max-w-6xl mx-auto p-4 flex justify-between items-center text-white">
    <h1 class="text-2xl font-extrabold">Mon Gestionnaire de Tâches</h1>
    <nav class="flex items-center gap-4">
        <a href="index.php?action=categories" class="bg-white/20 hover:bg-white/30 px-3 py-1 rounded-md">Catégories</a>
        <a href="index.php?action=log_out" class="hover:underline">Déconnexion</a>
    </nav>
</header>

<main class="max-w-6xl mx-auto py-8 px-4 space-y-6">

    <!-- Filtrage -->
    <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-xl p-6 flex gap-4 flex-wrap items-end">
        <form method="GET" action="index.php" class="flex flex-wrap gap-4 items-end w-full">
            <input type="hidden" name="action" value="tasks">

            <div>
                <label for="etat" class="block text-white font-medium text-sm">État</label>
                <select name="etat" id="etat" class="rounded-md border border-white/30 p-2 bg-white/30 text-gray-900">
                    <option value="">Tous</option>
                    <option value="en cours" <?= ($_GET['etat'] ?? '') === 'en cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="terminée" <?= ($_GET['etat'] ?? '') === 'terminée' ? 'selected' : '' ?>>Terminée</option>
                </select>
            </div>

            <div>
                <label for="category_id" class="block text-white font-medium text-sm">Catégorie</label>
                <select name="category_id" id="category_id" class="rounded-md border border-white/30 p-2 bg-white/30 text-gray-900">
                    <option value="">Toutes</option>
                    <?php foreach($categories as $cat): ?>
                        <option value="<?= $cat['idCategory'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['idCategory'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="sort" class="block text-white font-medium text-sm">Trier par date</label>
                <select name="sort" id="sort" class="rounded-md border border-white/30 p-2 bg-white/30 text-gray-900">
                    <option value="asc" <?= ($_GET['sort'] ?? '') === 'asc' ? 'selected' : '' ?>>Plus ancien → récent</option>
                    <option value="desc" <?= ($_GET['sort'] ?? '') === 'desc' ? 'selected' : '' ?>>Plus récent → ancien</option>
                </select>
            </div>

            <button type="submit" class="bg-indigo-600/70 hover:bg-indigo-700/70 text-white px-4 py-2 rounded-md">Filtrer</button>
        </form>
    </div>

    <!-- Ajouter tâche -->
    <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-xl p-6 space-y-4">
        <h2 class="text-xl font-semibold text-white">Ajouter une nouvelle tâche</h2>

        <?php if (!empty($errors)): ?>
            <div class="p-4 text-sm text-red-700 bg-red-100/30 rounded-lg">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php?action=add_task" method="POST" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="text" name="title" required placeholder="Titre de la tâche"
                       class="rounded-md border border-white/30 p-3 bg-white/30 placeholder-white/60">

                <select name="category_id" class="rounded-md border border-white/30 p-3 bg-white/30 placeholder-white/60">
                    <option value="">-- Catégorie --</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['idCategory'] ?>"><?= htmlspecialchars($cat['name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="date" name="date_limit" required
                       class="rounded-md border border-white/30 p-3 bg-white/30 placeholder-white/60">

                <button type="submit" class="bg-indigo-600/70 hover:bg-indigo-700/70 text-white py-2 px-4 rounded-md">Ajouter</button>
            </div>

            <textarea name="description" placeholder="Description (optionnel)"
                      class="w-full p-3 rounded-md border border-white/30 bg-white/30 placeholder-white/60 mt-2"></textarea>
        </form>
    </div>

    <!-- Liste des tâches -->
    <div class="bg-white/20 backdrop-blur-md border border-white/30 rounded-xl p-6 overflow-x-auto">
        <h2 class="text-2xl font-bold text-white mb-4">Liste des tâches</h2>
        <table class="min-w-full divide-y divide-white/30 text-white">
            <thead class="bg-white/10">
            <tr>
                <th class="px-6 py-3 text-left text-sm uppercase">Titre</th>
                <th class="px-6 py-3 text-left text-sm uppercase">Catégorie</th>
                <th class="px-6 py-3 text-left text-sm uppercase">Date limite</th>
                <th class="px-6 py-3 text-center text-sm uppercase">État</th>
                <th class="px-6 py-3"></th>
            </tr>
            </thead>
            <tbody>
            <?php if (empty($taches)): ?>
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-white/70">Aucune tâche trouvée.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($taches as $t):
                    $isDone = $t['state'] === 'terminée';
                    $badge = $isDone ? 'bg-green-500/30 text-green-200' : 'bg-yellow-500/30 text-yellow-200';
                    ?>
                    <tr class="<?= $isDone ? 'opacity-60' : '' ?>">
                        <td class="px-6 py-4"><?= htmlspecialchars($t['title']) ?><br><small class="text-white/70"><?= htmlspecialchars($t['description']) ?></small></td>
                        <td class="px-6 py-4"><?= htmlspecialchars($t['name'] ?? 'Sans catégorie') ?></td>
                        <td class="px-6 py-4"><?= date('d/m/Y', strtotime($t['date_limit'])) ?></td>
                        <td class="px-6 py-4 text-center"><span class="px-2 py-1 rounded-full <?= $badge ?>"><?= $t['state'] ?></span></td>
                        <td class="px-6 py-4 flex justify-end gap-2">
                            <a href="index.php?action=change_state&id=<?= $t['idTask'] ?>&etat=<?= $isDone ? 'en cours' : 'terminée' ?>" class="text-indigo-300 hover:text-white"><?= $isDone ? 'En cours' : 'Terminer' ?></a>
                            <a href="index.php?action=edit_task&id=<?= $t['idTask'] ?>" class="text-blue-300 hover:text-white">Modifier</a>
                            <a href="index.php?action=delete_task&id=<?= $t['idTask'] ?>" class="text-red-400 hover:text-red-200" onclick="return confirm('Supprimer cette tâche ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Floating Add Category Button -->
    <a href="index.php?action=categories"
       class="fixed bottom-6 right-6 bg-white/20 backdrop-blur-md border border-white/30 text-white px-5 py-3 rounded-full shadow-lg flex items-center gap-2 transition hover:bg-white/25 hover:shadow-xl">
        <span class="text-xl font-bold">+</span>
        <span class="font-medium">Catégories</span>
    </a>

</main>
</body>
</html>
