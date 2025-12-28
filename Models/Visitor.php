<?php 
require_once __DIR__ . "/../Models/User.php";

class Visitor extends User
{
    private bool $firstLogin;
    private bool $isActive;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }


    public function __construct(int $id, string $name, string $email, string  $password, string $role, bool $isActive, bool $firstLogin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->isActive = $isActive;
        $this->firstLogin = $firstLogin;
    }

    public function isFirstLogin(): bool
    {
        return $this->firstLogin;
    }

    public function setFirstLogin(bool $firstLogin): void
    {
        $this->firstLogin = $firstLogin;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setActive(bool $active): void
    {
        $this->isActive = $active;
    }

    public static function userActivation(int $sts, int $id_visitor): bool
    {
        $stmt = static::getDB()->prepare("UPDATE users SET is_active = ? WHERE id = ?");
        $sts ? $param = 0 : $param = 1;
        return $stmt->execute([$param , $id_visitor]);
        
    }

    public function canBookVisit(): bool
    {
        return $this->isActive;
    }

    public function canComment(): bool
    {
        return $this->isActive;
    }

    public function __toString(): string
    {
        return "Visitor[id={$this->getUserId()}, name={$this->getUserName()}, active={$this->isActive}]";
    }
}