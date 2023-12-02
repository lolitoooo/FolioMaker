<?php

namespace App\Core;

class DB
{
    public \PDO $conn;
    public string $table;

    public function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=mariadb;dbname=foliomakerdb", "foliomakeruser", "foliomakerpsw");
            echo "Connected successfully <br>";
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function tableName(): string
    {
        // Retourne le nom de la table en fonction du nom de la classe
        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $table = strtolower($table);
        $this->table = 'esgi_' . $table;

        return $this->table;
    }

    public function populate(int $id): array
    {
        // Populate l'ojet avec les données de la table
        $sql = "SELECT * FROM " . $this->tableName() . " WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $page = $stmt->fetch();
    
        return $page;
    }    

    public function save(array $data, ?int $id): void
    {
        // Colonnes de la table
        $columns = array_keys($data);
        $values = array_map(fn($value) => $this->conn->quote($value), $data);
        
        // Création des placeholders pour les valeurs
        $placeholders = implode(',', array_fill(0, count($values), '?'));
        
        if ($id !== null) {
            $columns = array_map(fn($column) => $column . ' = ?', $columns);
            
            // Création des placeholders pour les valeurs
            $placeholders = implode(',', $columns);
            
            // Préparation de la requête
            $sql = "UPDATE " . $this->tableName() . " SET " . implode(',', $columns) . " WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
        
            
            // Liaison des valeurs aux paramètres
            $i = 1;
            foreach ($data as $value) {
                $stmt->bindValue($i++, $value);
            }
        
            // Ajout de la liaison pour l'id à la fin
            $stmt->bindValue($i, $id);
            
            $stmt->execute();
            return;

        } else {
            // Préparation de la requête
            $sql = "INSERT INTO " . $this->tableName() . " (" . implode(",", $columns) . ") VALUES ($placeholders)";
            $stmt = $this->conn->prepare($sql);
            
            // Liaison des valeurs aux paramètres
            $i = 1;
            foreach ($values as $value) {
                $stmt->bindValue($i++, $value);
            }
            $stmt->execute();
        }
    }
}