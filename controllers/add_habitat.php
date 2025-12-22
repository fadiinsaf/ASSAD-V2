<?php 
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $zoo_zone = $_POST["zoo_zone"];

    $stmt = $db->prepare("INSERT INTO habitats(name,description,zoo_zone) VALUES (?,?,?)");
    $status = $stmt->execute([$name, $description, $zoo_zone]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /../src/admin_dashboard.php");
exit();