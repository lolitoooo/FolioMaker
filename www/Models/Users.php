<?php
namespace App\Models;
use App\Core\DB;
class Users extends DB
{
    private ?int $id = null;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected int $status = 0;
    protected int $isDeleted = 0;

    public static function findByEmail(string $email): ?self
    {
        $instance = new self();
        $result = $instance->getOneBy(['email' => $email, 'isDeleted' => 0], 'object');

        if ($result === false) {
            return null;
        }

        return $result;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE isDeleted = 0";
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS, self::class);
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $firstname = ucwords(strtolower(trim($firstname)));
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $lastname = strtoupper(trim($lastname));
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $email = strtolower(trim($email));
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isVerif(): bool
    {
        return $this->isVerif;
    }

    /**
     * @param bool $isVerif
     */
    public function setIsVerif(bool $isVerif): void
    {
        $this->isVerif = $isVerif;
    }

    /**
     * @return bool
     */
    public function isDeleted(): int
    {
        return $this->isDeleted;
    }

    /**
     * @param bool $isDeleted
     */
    public function setIsDeleted(int $isDeleted): void
    {
        $this->isDeleted = $isDeleted;
    }

    /**
     * @param array $data Associative array of user data to update.
     * @return bool Returns true on success or false on failure.
     */
    public function updateUser(array $data): void {
        if (!empty($data['firstname'])) {
            $this->firstname = $data['firstname'];
        }
        if (!empty($data['lastname'])) {
            $this->lastname = $data['lastname'];
        }
        if (!empty($data['email'])) {
            $this->email = $data['email'];
        }
        if (!empty($data['password'])) {
            $this->password = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        $this->status = $data['status'] ?? $this->status;
        $this->save();
    }

    /**
     * @return bool Returns true on success or false on failure.
     */
    public function softDeleteUser(): bool {
        if (empty($this->id)) {
            return false;
        }
        $this->isDeleted = 1; // Marquer comme supprimé
        $this->save(); // Sauvegarder le changement
        return true; // Renvoyer true explicitement
    }

    /**
     * @return bool Returns true on success or false on failure.
     */
    public function hardDeleteUser(): bool {
        if (empty($this->id)) {
            return false; 
        }
        $sql = "DELETE FROM ".$this->table." WHERE id = :id";
        $query = $this->pdo->prepare($sql);
        return $query->execute(['id' => $this->id]);
    }


}