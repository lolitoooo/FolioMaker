<?php
namespace App\Models;

use App\Core\DB;

class Menus extends DB {
    protected $table = "esgi_menus";


    public function getAllMenus() {
        $sql = "SELECT id, name, description, content, created_at, updated_at, deleted_at, user_updated_at FROM " . $this->table . " WHERE deleted_at IS NULL"; // Exclut les menus supprimés logiquement
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        return $results;
    }

    public function addMenu($name, $description, $content, $userUpdatedId) {
        $sql = "INSERT INTO " . $this->table . " (name, description, content, user_updated_at) VALUES (:name, :description, :content, :user_updated_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'description' => $description,
            'content' => $content,
            'user_updated_at' => $userUpdatedId
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getById($id) {
        $sql = "SELECT id, name, description, content, created_at, updated_at, deleted_at, user_updated_at FROM " . $this->table . " WHERE id = :id AND deleted_at IS NULL";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result;
    }

    public function updateMenu($id, $name, $description, $content, $userUpdatedId) {
        $content = trim($_POST['content']);
        $json = json_decode($content);
        if (json_last_error() !== JSON_ERROR_NONE) {
            die('Le JSON fourni est invalide.');
        }
        $content = json_encode($json); 

    
        $sql = "UPDATE " . $this->table . " SET name = :name, description = :description, content = :content, updated_at = NOW(), user_updated_at = :user_updated_at WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'name' => $name,
            'description' => $description,
            'content' => $content, 
            'user_updated_at' => $userUpdatedId
        ]);
    }
    
    public function deleteMenu($id) {
        $sql = "UPDATE " . $this->table . " SET deleted_at = NOW() WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    public function hardDeleteMenu($id) {
        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
