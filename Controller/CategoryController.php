<?php
require_once MODEL_PATH . 'Category.php';

class CategoryController {

    public function manageCategories() {
        $categorieModel = new Category();

        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=");
            exit;
        }
        else
            $userId = $_SESSION['user_id'];

        $categories = $categorieModel->getAllCategories($userId);
        require VIEW_PATH . 'categories.php';
    }

    public function addCategory() {
        $userId = $_SESSION['user_id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($name) {
                $categorieModel = new Category();
                $categorieModel->createCategorie($name, $userId);
            }
        }
        header('Location: index.php?action=categories');
        exit;
    }

    public function modifyCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'idCategory', FILTER_VALIDATE_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if ($id && $name) {
                $categorieModel = new Category();
                $categorieModel->updateCategorie($id, $name);
            }
        }
        header('Location: index.php?action=categories');
        exit;
    }

    public function deleteCategory() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id) {
            $categorieModel = new Category();
            $categorieModel->deleteCategorie($id);
        }

        header('Location: index.php?action=categories');
        exit;
    }
}
