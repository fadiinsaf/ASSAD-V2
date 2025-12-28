<?php 
    session_start();

    require_once __DIR__ . "/../database/database.php";
    require_once __DIR__ . "/../Models/Auth.php";
    require_once __DIR__ . "/../Models/Admin.php";
    require_once __DIR__ . "/../Models/Guide.php";
    require_once __DIR__ . "/../Models/Visitor.php";

    $db = Database::getConnection();
    Auth::$errors = [];
    Auth::$user = [];

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $password = $_POST["password"] ?? "";
        $email = $_POST["email"] ?? "";
        $email = trim($email);

        if(empty($email) || empty($password)){
            $_SESSION["errors"]["fields"] = "Please fill this field !";
            header("Location: /index.php");
            exit();
        }

        if(!Auth::login($db, $email, $password))
        {
            $_SESSION["errors"] = Auth::$errors;
            $_SESSION["old_data"] = ['email' => $email];
            header("Location: /index.php");
            exit();
        }

        unset($_SESSION["errors"]);

        if(Auth::$user["role"] === "admin"){
            $admin = new Admin((int)Auth::$user["id"],Auth::$user["name"],Auth::$user["email"],Auth::$user["password"],Auth::$user["role"]);
            $_SESSION["user"] = $admin;
            header( "Location: " . Auth::redirectPath($admin));
            exit();
        }

        elseif(Auth::$user["role"] === "guide")
        {
            $guide = new Guide((int)Auth::$user["id"],Auth::$user["name"],Auth::$user["email"],Auth::$user["password"],Auth::$user["role"], Auth::$user["is_approved"],Auth::$user["firstlogin"]);
            $guide->setFirstLogin($db);
            $_SESSION["user"] = $guide;
            header("Location: " . Auth::redirectPath($guide));
            exit();
        }

        else
        {
            $visitor = new Visitor((int)Auth::$user["id"],Auth::$user["name"],Auth::$user["email"],Auth::$user["password"],Auth::$user["role"],Auth::$user["is_active"],Auth::$user["firstlogin"]);
            $_SESSION["user"] = $visitor;
            header("Location: " . Auth::redirectPath($visitor));
            exit();
        }
    }

    header("Location: ../index.php");
    exit();
?>