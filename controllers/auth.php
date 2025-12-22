<?php 
    session_start();

    require_once __DIR__ . "/../database/database.php";

        function login($role, $approved): never{

        if($role === "admin") {
            header("Location: ../src/admin_dashboard.php");
            exit();
        }
        elseif($role === "guide" && $approved){
            header("Location: ../src/guider_dashboard.php");
            exit();
        } 
        elseif($role === "guide" && !$approved) {
            header("Location: ../src/wait_admin_approving.php");
            exit();
        }
        else{
            header("Location: ../src/home.php");
            exit(); 
        }    
        } 
        function updateFirtsLogin($db, $id){
            $stmt = $db->prepare("UPDATE users SET firstlogin = ? WHERE id =?");
            $status = $stmt->execute([0,$id]);
            if(!$status){
                $_SESSION['errors']['database'] = "Login failed. Please try again!";
                header("Location: ../index.php");
                exit();
            }
        }

        function updatePasswordSecurity($db,$password,$id){
            $stmt = $db->prepare("UPDATE users SET password = ? WHERE id =?");
            $status = $stmt->execute([$password,$id]);
            if(!$status){
                $_SESSION['errors']['database'] = "Login failed. Please try again!";
                header("Location: ../index.php");
                exit();
            }
        }

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        
        $password = $_POST["password"] ?? "";
        $email = $_POST["email"] ?? "";
        $remember_me = $_POST["remember_me"];

        $email = trim($email);

        $errors = [];

        if(empty($email) || empty($password)){
            $errors["fields"] = "Please fill this field !";
        }

        if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" , $email)){
            $errors["email"] = "Email invalid !";
        }

        if(empty($errors)){
            $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            
            $user = $stmt->fetch();

            if(empty($user)){
                $errors["email"] = "Email invalid !";
            }
        }

        if(isset($user) && is_array($user)){
        if (strlen($user["password"]) < 60) {
            if ($user["password"] !== $password) {
                $errors['password'] = "Wrong password";
            } else {
                $new_hashed_password = password_hash($password, PASSWORD_DEFAULT);
                updatePasswordSecurity($db, $new_hashed_password, $user["id"]);
            }
        } else {
            if (!password_verify($password, $user["password"])) {
                $errors['password'] = "Wrong password";
            }
        }
        }

        
        if(!empty($errors)){
            $_SESSION["errors"] = $errors;

            $_SESSION["old_data"] = [
            'email' => $email
        ];
            header("Location: ../index.php");
            exit();
        }

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["user_is_active"] = $user["is_active"];
        $_SESSION["role"] = $user["role"];
        unset($_SESSION["errors"]);

        if($user["firstlogin"]){
            updateFirtsLogin($db,$user["id"]);
        }

        login($user["role"],$user["is_approved"]);
    }

    header("Location: ../index.php");
    exit();
?>