<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require 'config/Constant.php';

require CONTROLLER_PATH . 'AuthController.php';
require CONTROLLER_PATH . 'CategoryController.php';
require CONTROLLER_PATH . 'TaskController.php';

if(!isset($_GET['action'])){
    $_GET['action'] = '';
}
$action = $_GET['action'] ?? '';

$authController = new AuthController();
$taskController = new TaskController();
$categoryController = new CategoryController();

switch($action){

    case '':
        require_once VIEW_PATH . 'welcome.php';
        break;

    // ====================
    // AUTHENTICATION
    // ====================
    case 'sign_up':
        $authController->signUp();
        break;
    case 'login':
        $authController->login();
        break;
    case 'log_out':
        $authController->logOut();
        break;

    // ====================
    // TASKS
    // ====================
    case 'tasks':
        $taskController->homepage();
        break;
    case 'add_task':
        $taskController->addTask();
        break;
    case 'edit_task':
        $taskController->editTask();
        break;
    case 'check_edit_task':
        $taskController->checkEditTask();
        break;
    case 'change_state':
        $taskController->changeState();
        break;
    case 'delete_task':
        $taskController->deleteTask();
        break;

    // ====================
    // CATEGORIES
    // ====================
case 'categories':
    $categoryController->manageCategories();
    break;
case 'add_category':
    $categoryController->addCategory();
    break;
case 'modify_category':
    $categoryController->modifyCategory();
    break;
case 'delete_category':
    $categoryController->deleteCategory();
    break;

    // ====================
    // DEFAULT / 404
    // ====================
    default:
        include VIEW_PATH . '404.php';
        break;
}
