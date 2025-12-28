<?php 

require_once __DIR__ . "/../Models/User.php";
class Guide extends User
{
    private bool $firstLogin;
    private bool $isApproved;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function __construct(int $id, string $name, string $email, string  $password, string $role, bool $isApproved, bool $firstLogin)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->isApproved = $isApproved;
        $this->firstLogin = $firstLogin;
    }

    public function isFirstLogin(): bool
    {
        return $this->firstLogin;
    }

    public function setFirstLogin(PDO $db)
    {
        if($this->firstLogin)
        {
            $stmt = $db->prepare("UPDATE users SET firstlogin = 0 WHERE id = ?");
            $stmt->execute([$this->id]);
        }
        
        $this->firstLogin = 0;
    }

    public function isApproved(): bool
    {
        return $this->isApproved;
    }

    public static function setApproved(int $id): bool
    {
        $stmt = static::getDB()->prepare("UPDATE users SET is_approved = ? WHERE id = ?");
        return $stmt->execute([1 , $id]);
    }

    public function __toString(): string
    {
        return "Guide[id={$this->getUserId()}, name={$this->getUserName()}, approved={$this->isApproved}]";
    }
}