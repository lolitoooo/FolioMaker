<?php

namespace App\Models;
use App\Core\DB;

class Users extends DB{

    private int $id = 0;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;
    private int $status = 0;
    private bool $isDeleted = false;

    public function getId(): int {
        return $this->id;
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
