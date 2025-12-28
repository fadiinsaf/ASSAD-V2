<?php

require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Animal.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $species = $_POST["species"];
    $short_description = $_POST["short_description"];
    $diet_type = $_POST["diet_type"];
    $id_habitat = $_POST["id_habitat"];
    $image = $_FILES["image"];

    if(Animal::updateAnimal($id, $name, $diet_type, $short_description, $id_habitat, $image, $species)){
        header("Location: /../Views/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /../Views/admin_dashboard.php");
exit();