<?php

class Auth
{
    public static array $errors = [];
    public static array $user = [];


    private function __construct() {}
    private function __clone() {}

    public static function getErrors(): array
    {
        return self::$errors;
    }

    public static function getUser(): array
    {
        return self::$user;
    }

    public static function findUser(PDO $db ,$email){
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function  login(PDO $db, string $email, string $password): bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::$errors["email"] = "Email invalid!";
            return false;
        }

        $user = static::findUser($db, $email);

        if (!$user) 
        {
            self::$errors["email"] = "Email invalid!";
            return false;
        }

        if(strlen($user["password"]) < 60)
        {
            if($password !== $user["password"])
            {
                self::$errors["password"] = "Wrong password";
                return false;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT); 
            self::updatePassword($db,$hashed_password , $user["id"]);
            $user["password"] = $hashed_password;
        }
        else
            {
                if(!password_verify($password, $user["password"])) 
                {
                    self::$errors["password"] = "Wrong password";
                    return false;
                }
            }

        self::$user = $user;
        return true;
    }

    public static function  logout(): never
    {
        session_start();
        session_destroy();
        header("Location: ../index.php");
        exit();
    }

    public static function  inscription(PDO $db, string $name, string $email, string $password, string $confirm_password): bool
    {
        if(!preg_match("/^[A-Za-z\s]{2,50}$/" , $name)){
            self::$errors["name"] = "Name invalid !";
            return false;
        }

        if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" , $email)){
            self::$errors["email"] = "Email invalid !";
            return false;
        }

        if(strlen($password) > 59){
            self::$errors["password_length"] = "Password is too long !";
            return false;
        }

        if($password !== $confirm_password){
            self::$errors["passwords_match"] = "Passwords Not Match !";
            return false;
        }

        if(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/" , $password)){
            self::$errors["password"] = "Password is Weak / Invalid, Try Strong Passwords !";
            return false;
        }

        if(static::findUser($db ,$email)){
            static::$errors["email_exists"] = "Email already exists !"; 
            return false;
        }

        return true;
    }

    public static function updatePassword(PDO $db, string $hashedPassword, int $id): bool
    {
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");

        if($stmt->execute([$hashedPassword, $id]))
        {
            self::$user["password"] = $hashedPassword;
            return true;
        }

        return false;
    }
    public static function RedirectPath(User $user): string
    {
        if ($user instanceof Admin) {
            return "../Views/admin_dashboard.php";
        }

        if ($user instanceof Guide) {
            return $user->isApproved() ? "../Views/guider_dashboard.php" : "../Views/wait_admin_approving.php";
        }

        return "../Views/home.php";
    }
}