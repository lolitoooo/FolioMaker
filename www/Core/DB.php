<?php

namespace App\Core;

class DB
{
    protected $pdo;
    protected $prefix = "esgi_";
    protected $table;
    public function __construct()
    {
        //Connexion à la bdd
        try{
            $this->pdo = new \PDO("pgsql:host=db;port=5432;dbname=foliomakerdb", "foliomakeruser", "foliomakerpsw");
        }catch (\PDOException $exception){
            echo "Erreur de connexion à la base de données : ".$exception->getMessage();
        }
        $table = get_called_class();
        $table = explode("\\", $table);
        $table = array_pop($table);
        $this->table = $this->prefix.strtolower($table);
    }

    public function getChlidVars(): array
    {
        $vars = array_diff_key(get_object_vars($this), get_class_vars(get_class()));
        return $vars;
    }
    public function save(): void
    {
        //Création et execution d'une requête insert SQL
        $childVars = $this->getChlidVars();
        if (empty($this->getId())) {
            //echo "insert";
            $sql = "INSERT INTO ".$this->table." (".implode(", ", array_keys($childVars)).")
            VALUES (:".implode(", :", array_keys($childVars)).")";
        }else{
            //echo "update";
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

    public function getOnByEmail(string $email): bool
    {
        $sql = "SELECT * FROM ".$this->table." WHERE email=:email";
        $query = $this->pdo->prepare($sql);
        $query->execute(["email"=>$email]);
        $result = $query->fetch();
        
        return $result !== false;
    }

    public static function populate($id): object|int
    {
        return (new static())->getOneBy(["id" => $id], "object");
    }

    public function getOneBy(array $data, $return = "array"): object|false
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE ";
        foreach ($data as $key => $value) {
            $sql .= $key . "=:" . $key . " AND ";
        }
        $sql = substr($sql, 0, -5);
        $query = $this->pdo->prepare($sql);
        $query->execute($data);

        if ($return == "object") {
            $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        }

        $result = $query->fetch();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

}