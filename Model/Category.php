<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = Database::connexion();
    }

public function getAllCategories($userId) {
    $sql = "SELECT idCategory, name FROM tbl_category WHERE user_id = :user_id ORDER BY name ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function createCategorie($name, $userId) {
    $sql = "INSERT INTO tbl_category (name, user_id) VALUES (:name, :user_id)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    return $stmt->execute();
}

    public function updateCategorie($id, $name) {
        $sql = "UPDATE tbl_category SET name = :name WHERE idCategory = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur modification catégorie: " . $e->getMessage());
            return false;
        }
    }

    public function deleteCategorie($id) {
        $sql = "DELETE FROM tbl_category WHERE idCategory = :id";
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erreur suppression catégorie: " . $e->getMessage());
            return false;
        }
    }
}
