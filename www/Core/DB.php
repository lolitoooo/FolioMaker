<?php

namespace App\Core;
require("config/config.php");

class DB
{
    protected $pdo;
    protected $prefix = PREFIX;
    protected $table;
    public function __construct()
    {
        
        //Connexion à la bdd
        try{
            $this->pdo = new \PDO(CONNECT, DB_USER, DB_PASSWORD);
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

    public function getAll($return = "array"): array|false
    {
        $sql = "SELECT * FROM " . $this->table;
        $query = $this->pdo->prepare($sql);
        $query->execute();

        if ($return == "object") {
            $query->setFetchMode(\PDO::FETCH_CLASS, get_called_class());
        }

        $result = $query->fetchAll();

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function lastInsertId(): int {
        return $this->pdo->lastInsertId();
    }
 
    public function login(string $email, string $password): int
    {
        $user = $this->getOneBy(["email" => $email], "object");
    
        if ($user) {
            if (password_verify($password, $user->getPassword())) {
                $_SESSION['user_id'] = $user->getId();
                $sql = "SELECT isverif FROM " . $this->table . " WHERE email=:email";
                $query = $this->pdo->prepare($sql);
                $query->execute(["email" => $email]);
                $result = $query->fetch();
    
                if ($result['isverif'] == 1) {
                    return 1; // Connexion réussie
                } else {
                    return 2; // Compte non vérifié par e-mail
                }
            } else {
                return 3;     // Mot de passe incorrect
            }
        }
        return 4;             // Adresse e-mail incorrecte
    }

    public function verifyEmail($emailToVerify): bool
    {
        $sql = "UPDATE " . $this->table . " SET isverif = true WHERE email = :email";
        $query = $this->pdo->prepare($sql);
        $query->execute(['email' => $emailToVerify]);

        return $query->rowCount() > 0;
    }

}