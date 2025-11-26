<?php

require CONFIG_PATH . 'dbInfo.php';

class User {
    private $db;

    public function __construct() {
        $this->db = Database::connexion();
    }

    public function createUser($email, $password_hash) {
       
        $sql = "INSERT INTO tbl_User (email, password_hash) VALUES (:email, :password_hash)";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password_hash', $password_hash);
            $stmt->execute();
            
            return "L'utilisateur a été crée avec succés";
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function emailExists($email) {
        
        $sql = "SELECT idUser FROM tbl_User WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        // Si fetch() retourne une ligne, l'email existe
        return $stmt->fetch() ? true : false;
        
    }

    public function getUserByEmail($email) {

        // Nous sélectionnons explicitement les champs nécessaires
        $sql = "SELECT idUser, email, password_hash FROM tbl_User WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        return $stmt->fetch(); 
        
    }
}