<?php
require_once MODEL_PATH . 'Tasks.php';
require_once MODEL_PATH . 'Category.php';

class TaskController {

    public function homepage($errors = []) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $taskModel = new Tasks();
        $categoryModel = new Category();

        // Filtreler
        $etatFilter = $_GET['etat'] ?? '';
        $categorieFilter = $_GET['category_id'] ?? '';
        $sort = $_GET['sort'] ?? 'asc'; // asc = croissant, desc = décroissant

        $taches = $taskModel->getTaches($userId, $etatFilter, $categorieFilter, $sort);
        $categories = $categoryModel->getAllCategories($userId);

        require VIEW_PATH . 'tasks.php';
    }



    public function addTask() {

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $taskModel = new Tasks();

            $titre       = trim($_POST['title'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $date        = $_POST['date_limit'] ?? null;
            $categorieId = $_POST['category_id'] ?? null;
            $userId      = $_SESSION['user_id'];

            if (empty($date)) {
                $errors[] = "La date limite est obligatoire.";
            }

            if (empty($titre)) {
                $errors[] = "Le titre est obligatoire.";
            }

            if (empty($categorieId)) {
                $categorieId = null;
            }

            if (empty($errors)) {
                $taskModel->createTache(
                    $titre,
                    $description,
                    $date,
                    $categorieId,
                    $userId
                );

                header('Location: index.php?action=tasks');
                exit;
            }
        }

        $this->homepage($errors ?? []);
    }

    public function changeState() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $etat = filter_input(INPUT_GET, 'etat', FILTER_SANITIZE_STRING);

        if ($id && in_array($etat, ['en cours', 'terminée'])) {
            $taskModel = new Tasks();
            $taskModel->updateEtat($id, $etat);
        }

        header('Location: index.php?action=tasks');
        exit;
    }

    public function deleteTask() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $taskModel = new Tasks();
            $taskModel->deleteTache($id);
        }
        header('Location: index.php?action=tasks');
        exit;
    }

    public function editTask() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: index.php?action=tasks');
            exit;
        }

        $taskModel = new Tasks();
        $categoryModel = new Category();
        $userId = $_SESSION['user_id'];

        $tache = $taskModel->getTacheById($id);
        $categories = $categoryModel->getAllCategories($userId);

        require VIEW_PATH . 'editTask.php';
    }

    public function checkEditTask() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $taskModel = new Tasks();
            $id = filter_input(INPUT_POST, 'idTask', FILTER_VALIDATE_INT);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date_limit = $_POST['date_limit'] ?? null;
            $state = $_POST['state'];
            $category_id = $_POST['category_id'] ?? null;

            if ($category_id === '') {
                $category_id = null;
            }

            if ($id && $title && $date_limit && in_array($state, ['en cours', 'terminée'])) {
                $taskModel->updateTache($id, $title, $description, $date_limit, $state, $category_id);

            }

            header('Location: index.php?action=tasks');
            echo $category_id;

            exit;
        }
    }
}
