<?php 
    session_start();

    require_once __DIR__ . "/../database/database.php";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $role = $_POST["role"];
        $name = $_POST["name"] ?? "";
        $email = $_POST["email"] ?? "";
        $password = $_POST["password"] ?? "";
        $confirm_password = $_POST["confirm_password"] ?? "";
        $accept_terms = $_POST["accept_terms"] ?? "";

        $name = trim($name);
        $email = trim($email);

        $errors = [];

        if(empty($role) || empty($name) || empty($email) || empty($password) || empty($confirm_password)){
            $errors["fields"] = "Please fill this field !";
        }

        if(!preg_match("/^[A-Za-z\s]{2,50}$/" , $name)){
            $errors["name"] = "Name invalid !";
        }

        if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" , $email)){
            $errors["email"] = "Email invalid !";
        }

        if(strlen($password) > 72){
            $errors["password_length"] = "Password is too long !";
        }

        if($password !== $confirm_password){
            $errors["passwords_match"] = "Passwords Not Match !";
        }

        if(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/" , $password)){
            $errors["password"] = "Password is Weak / Invalid, Try Strong Passwords !";
        }

            if(empty($accept_terms)){
            $errors["accept_terms"] = "You must Accept The Terms of Service and Privacy Policy !";
        }

        if(empty($errors)){
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            if($stmt->fetch()){
                $errors["email_exists"] = "Email already exists !"; 
            }
        }
        
        if(!empty($errors)){
            $_SESSION["errors"] = $errors;

            $_SESSION["old_data"] = [
            'role' => $role,
            'name' => $name,
            'email' => $email
        ];
            header("Location: /src/register.php");
            exit();
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("INSERT INTO users (name,email,role,password) VALUES(?,?,?,?)");
        $status = $stmt->execute([$name,$email,$role,$hashed_password]);

        if($status){
            unset($_SESSION['errors']);
            unset($_SESSION['old_data']);

            $role === "guide" ? header("Location: /src/wait_admin_approving.php") : header("Location: ../index.php");
            exit();
        }

        $_SESSION['errors']['database'] = "Registration failed. Please try again!";
        $_SESSION['old_data'] = [
            'role' => $role,
            'name' => $name,
            'email' => $email
        ];
        header("Location: /src/register.php");
        exit();
    }
    header("Location: /src/register.php");
    exit();
?>