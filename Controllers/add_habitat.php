<?php 
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Habitat.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $description = $_POST["description"];
    $zoo_zone = $_POST["zoo_zone"];

    if(Habitat::createHabitat($name, $description, $zoo_zone)){
        header("Location: /../Views/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /../Views/admin_dashboard.php");
exit();