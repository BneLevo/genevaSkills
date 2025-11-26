<?php
require_once CONFIG_PATH . 'dbInfo.php';

class Tasks {
    private $db;
    private $tableName = 'tbl_task';

    public function __construct() {
        $this->db = Database::connexion();
    }

    public function getTaches($userId, $etat = '', $categorieId = '', $sort = 'asc') {
        $sql = "SELECT t.*, c.name 
            FROM tbl_task t 
            LEFT JOIN tbl_category c ON t.category_id = c.idCategory 
            WHERE t.user_id = :userId";

        if ($etat) {
            $sql .= " AND t.state = :etat";
        }

        if ($categorieId) {
            $sql .= " AND t.category_id = :categorieId";
        }

        // Tarihe göre sıralama
        $sql .= " ORDER BY t.date_limit " . ($sort === 'desc' ? 'DESC' : 'ASC');

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($etat) $stmt->bindParam(':etat', $etat, PDO::PARAM_STR);
        if ($categorieId) $stmt->bindParam(':categorieId', $categorieId, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public function createTache($title, $description, $date, $categoryId, $userId) {

        $sql = "INSERT INTO tbl_task 
            (title, description, date_limit, state, category_id, user_id)
            VALUES (:title, :description, :date_limit, 'en cours', :category_id, :user_id)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date_limit', $date);

        // NULL kategori desteği
        if ($categoryId === null) {
            $stmt->bindValue(':category_id', null, PDO::PARAM_NULL);
        } else {
            $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        }

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function updateEtat($id, $etat) {
        $sql = "UPDATE tbl_task SET state = :etat WHERE idTask = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':etat', $etat);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteTache($id) {
        $sql = "DELETE FROM tbl_task WHERE idTask = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getTacheById($id) {
        $sql = "SELECT * FROM tbl_task WHERE idTask = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateTache($id, $title, $description, $date_limit, $state, $category_id) {
        $sql = "UPDATE tbl_task SET title=:title, description=:desc, date_limit=:date, state=:state, category_id=:cat WHERE idTask=:id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':desc', $description);
        $stmt->bindParam(':date', $date_limit);
        $stmt->bindParam(':state', $state);
        $stmt->bindParam(':cat', $category_id, PDO::PARAM_INT);


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
