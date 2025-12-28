<?php

require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Animal.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $diet_type = $_POST["diet_type"];
    $idhab = $_POST["id"];
    $species = $_POST["species"];
    $description = $_POST["short_description"];
    $image = $_FILES["image"];

    if(Animal::createAnimal($image, $name, $species, $diet_type, $description, $idhab)){
        header("Location: /../Views/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

    header("Location: /../Views/admin_dashboard.php");
exit();