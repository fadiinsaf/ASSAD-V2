<?php
abstract class User
{
    protected int $id;
    protected string $name;
    protected string $email;
    protected string $password;
    protected string $role;
    protected DateTime $created_at;

    private static ?PDO $db = null;

    private static function getDB(): PDO {
        if (self::$db === null) {
            self::$db = Database::getConnection();
        }
        return self::$db;
    }

    public function getUserId(): int
    {
        return $this->id;
    }
    public function getUserName(): string
    {
        return $this->name;
    }

    public function getUserEmail(): string
    {
        return $this->email;
    }

    public function getUserPassword(): string
    {
        return $this->password;
    }

    public function getUserRole(): string
    {
        return $this->role;
    }

    public function getUserCreatedDateTime(): string
    {
        return $this->created_at->format("Y-m-d H:i:s");
    }


    public function setUserId(int $id): void
    {
        if (is_int($id)) {
            $this->id = $id;
        } else {
            die();
        }
    }

    public function setUserName(string $name): void
    {

        if (preg_match("/^[A-Za-z\s]{2,50}$/", $name)) {
            $this->name = $name;
        } else {
            die();
        }
    }

    public function setUserEmail(string $email): void
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            die();
        }
    }

    public function setUserPassword(string $password): void
    {

        if (preg_match("/^(?=.*[A-Z])(?=[a-z].*)(?=.*\d)(?=.*[!@^&~#-_$*]).{8,}$/", $password)) {
            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);

            $this->password = $passwordHashed;
        } else {
            die();
        }
    }

    public static function getAll(){
        return static::getDB()->query("SELECT * FROM users WHERE role != 'admin'", PDO::FETCH_ASSOC)
                        ->fetchAll();
    }

    public static function updateFirstLogin(PDO $db, int $id): bool
    {
        $stmt = $db->prepare("UPDATE users SET firstlogin = 0 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function addUser(string $name ,string $email ,string $role , string $password){
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = static::getDB()->prepare("INSERT INTO users (name,email,role,password) VALUES(?,?,?,?)");
        return $stmt->execute([$name,$email,$role,$hashed_password]);
    }

    public function __tostring(): string
    {
        return "User[id={$this->id}, name={$this->name}, email={$this->email}, role={$this->role}]";;
    }
}