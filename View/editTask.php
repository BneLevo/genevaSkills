<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer Tâche</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl p-8 bg-white/20 backdrop-blur-md border border-white/30 rounded-xl shadow-2xl">

    <h2 class="text-2xl font-bold text-white mb-6 text-center">Éditer la Tâche</h2>

    <!-- ERROR MESSAGES -->
    <?php if (!empty($errors)): ?>
        <div class="mb-4 p-4 rounded-lg bg-red-100/30 text-red-700 text-sm">
            <ul class="list-disc list-inside">
                <?php foreach ($errors as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?action=check_edit_task" method="POST" class="space-y-4">

        <input type="hidden" name="idTask" value="<?= htmlspecialchars($tache['idTask']) ?>">

        <div>
            <label for="titre" class="block text-sm font-medium text-white">Titre</label>
            <input type="text" id="titre" name="title" required
                   value="<?= htmlspecialchars($tache['title']) ?>"
                   class="w-full rounded-md border border-white/30 bg-white/10 text-white placeholder-white/60 shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-white">Description</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full rounded-md border border-white/30 bg-white/10 text-white placeholder-white/60 shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500 text-sm"><?= htmlspecialchars($tache['description']) ?></textarea>
        </div>

        <div>
            <label for="date_limit" class="block text-sm font-medium text-white">Date limite</label>
            <input type="date" id="date_limite" name="date_limit" required
                   value="<?= htmlspecialchars($tache['date_limit']) ?>"
                   class="w-full rounded-md border border-white/30 bg-white/10 text-white placeholder-white/60 shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
        </div>

        <div>
            <label for="state" class="block text-sm font-medium text-white">État</label>
            <select id="state" name="state" class="w-full rounded-md border border-white/30 bg-white/10 text-white shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                <option value="en cours" <?= $tache['state'] === 'en cours' ? 'selected' : '' ?>>En cours</option>
                <option value="terminée" <?= $tache['state'] === 'terminée' ? 'selected' : '' ?>>Terminée</option>
            </select>
            </select>
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-white">Catégorie</label>
            <select id="category_id" name="category_id"
                    class="w-full rounded-md border border-white/30 bg-white/10 text-white shadow-sm p-3 focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                <option value="">-- Choisir Catégorie --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['idCategory'] ?>"
                            <?= $tache['category_id'] == $cat['idCategory'] ? 'selected' : '' ?>
                            class="rounded-md border border-white/30 p-3 bg-white/30 text-gray-900">
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

        </div>

        <button type="submit"
                class="w-full py-2 px-4 rounded-md bg-indigo-600/70 hover:bg-indigo-700/70 text-white font-medium shadow-md transition duration-150">
            Mettre à jour
        </button>

        <a href="index.php?action=tasks" class="block mt-4 text-center text-white/80 hover:text-white text-sm">
            Annuler et revenir à la liste
        </a>
    </form>
</div>

</body>
</html>
