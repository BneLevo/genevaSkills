<?php

require_once MODEL_PATH . 'User.php';

class AuthController{

    public function signUp(){
        
        $user = new User();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            // 2. Filtrage et validation des données (Email, Mot de passe, Confirmation)
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $password = $_POST['password'] ?? null;
            $passwordCheck = $_POST['passwordCheck'] ?? null;
            
            // a) Validation Email
            if (!$email) {
                $errors[] = "L'adresse email n'est pas valide.";
            } 
            else if ($user->emailExists($email)) {
                $errors[] = "Cette adresse email est déjà utilisée.";
            }

            if (empty($password) || strlen($password) < 8) {
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
            } elseif ($password !== $passwordCheck) { 
                $errors[] = "Les mots de passe ne correspondent pas.";
            }
            
            // 3. Traitement si aucune erreur
            if (empty($errors)) {
                
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $userId = $user->createUser($email, $password_hash);
                
                if ($userId)
                    header('Location: index.php?action=login');
                else 
                    $errors[] = "Erreur lors de l'enregistrement de l'utilisateur (problème de base de données).";
                
            }
        }

        require VIEW_PATH . 'sign_up.php';
    }

public function login() {

    $user = new User();
    $errors = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $user = $user->getUserByEmail($email);

        if (!$user) {
            $errors[] = "Adresse email incorrecte.";
        } else {
            if (!password_verify($password, $user['password_hash'])) {
                $errors[] = "Mot de passe incorrect.";
            } else {
                session_start();
                $_SESSION['user_id'] = $user['idUser'];
                $_SESSION['email'] = $user['email'];

                header('Location: index.php?action=tasks');
            }
        }
    }

    require VIEW_PATH . 'login.php';
}


    // --- Fonction de Déconnexion ---
    public function logOut(){
        // Vider toutes les variables de session
        session_unset(); 
        // Détruire la session
        session_destroy(); 
        // Rediriger vers la page d'accueil ou de connexion
        header('Location: index.php');
        exit;
    }
}