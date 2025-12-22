<?php 
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = $_POST["id"];
    

    $stmt = $db->prepare("UPDATE users SET is_approved = ? WHERE id = ?");
    $status = $stmt->execute([1 , $id]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }
    echo "Error";
    die();
}

header("Location: /../src/admin_dashboard.php");
exit();