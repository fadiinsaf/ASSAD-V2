<?php 
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $zoo_zone = $_POST["zoo_zone"];
    $description = $_POST["description"];
    
    $stmt = $db->prepare("UPDATE habitats SET name = ?, description = ?, zoo_zone = ? WHERE id = ?");
    $status = $stmt->execute([$name , $description, $zoo_zone, $id]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

        header("Location: /../src/admin_dashboard.php");

exit();
?>