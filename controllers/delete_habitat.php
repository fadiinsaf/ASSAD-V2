<?php 
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];

    $stmt = $db->prepare("DELETE FROM habitats WHERE id = ?");
    $status = $stmt->execute([$id]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}
header("Location: /../src/admin_dashboard.php");
exit();