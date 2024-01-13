<?php

namespace App\Core;

class DB
{
    private $pdo;
    private $prefix = "esgi_";
    private $table;
    public function __construct()
    {
        //Connexion à la bdd
        try {
            $this->pdo = new \PDO("pgsql:host=db;port=5432;dbname=foliomakerdb", "foliomakeruser", "foliomakerpsw");
        } catch (\Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = $this->prefix.strtolower($table);
    }

    public static function getDb(): \PDO
{
    $pdo = new \PDO("pgsql:host=db;port=5432;dbname=foliomakerdb", "foliomakeruser", "foliomakerpsw");
    $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

    public function getChlidVars(): array
    {
        $vars = array_diff_key(get_object_vars($this), get_class_vars(get_class()));
    $vars = array_change_key_case($vars, CASE_LOWER); // Convertir toutes les clés en minuscules
    var_dump($vars); // Pour le débogage
    return $vars;
    }

    public function save(): void
    {
        //Création et execution d'une requête insert SQL
        $childVars = array_unique($this->getChlidVars());

            // Assurez-vous que status et isdeleted ne sont pas vides
        if (empty($childVars['status'])) {
            $childVars['status'] = 0; // ou une autre valeur par défaut
        }
        if (empty($childVars['isdeleted'])) {
            $childVars['isdeleted'] = 0; // ou une autre valeur par défaut
        }
        if (empty($this->getId())) {
            echo "insert";
            $sql = "INSERT INTO ".$this->table." (".implode(", ", array_keys($childVars)).")
            VALUES (:".implode(", :", array_keys($childVars)).")";
        }else{
            echo "update";
            $sql = "UPDATE ".$this->table." SET ";
            foreach ($childVars as $key => $value){
                $sql .= $key."=:".$key.", ";
            }
            $sql = substr($sql, 0, -2);
            $sql .= " WHERE id=:id";
            $childVars["id"] = $this->getId();
        }
        $query = $this->pdo->prepare($sql);
        $query->execute($childVars);

    }


    public static function populate($id): object|int
    {
        return (new static())->getOneBy(["id" => $id], "object");
    }

    public function getOneBy(array $data, $return = "array"): object|array|int
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        foreach ($data as $key => $value) {
            $sql .= $key . "=:" . $key . " AND ";
        }
        $sql = substr($sql, 0, -5);
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        if($return == "object")
            $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        return $query->fetch();
    }
}