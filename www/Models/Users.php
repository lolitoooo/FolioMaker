<?php

namespace App\Models;
use App\Core\DB;
use PDO;

class Users extends DB{


    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public int $status = 0;
    public bool $isDeleted = false;

    public function __construct() {
        parent::__construct(); 
        $this->firstname = '';
        $this->lastname = '';
        $this->email = '';
        $this->password = '';
        $this->status = 0; 
        $this->isDeleted = false;    
    }

    public static function findByEmail($email)
{
    $pdo = self::getDb();
    $sql = "SELECT * FROM esgi_users WHERE email = :email";
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $userModel = new Users();
        $userModel->id = $user['id'];
        $userModel->firstname = $user['firstname'];
        $userModel->lastname = $user['lastname'];
        $userModel->email = $user['email'];
        $userModel->password = $user['password'];

        return $userModel;
    }

    return null;
}

    


    public function getId(): ?int
    {
        return $this->id ?? null;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): void {
        $firstname = ucfirst(strtolower(trim($firstname)));
        $this->firstname = $firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function setLastname(string $lastname): void {
        $lastname = strtoupper(trim($lastname));
        $this->lastname = $lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $email = strtolower(trim($email));                       
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $password = password_hash($password, PASSWORD_DEFAULT);       
        $this->password = $password;
    }

    public function getStatus(): int {
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getIsDeleted(): bool {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): void {
        $this->isDeleted = $isDeleted;
    }

}
