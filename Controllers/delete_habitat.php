<?php 
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Habitat.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];

    if(Habitat::deleteHabitat($id)){
        header("Location: /../Views/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}
header("Location: /../Views/admin_dashboard.php");
exit();