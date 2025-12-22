<?php

require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $id = $_POST["id"];

    $stmt = $db->prepare("SELECT image FROM animals WHERE id = ?");
    $stmt->execute([$id]);

    $image = $stmt->fetchColumn();

    unlink(__DIR__ . "/../assets/$image");

    $name = $_POST["name"];
    $species = $_POST["species"];
    $short_description = $_POST["short_description"];
    $diet_type = $_POST["diet_type"];
    $id_habitat = $_POST["id_habitat"];
    $image = $_FILES["image"];

    $current_time = new DateTime();
    $image_name =  $current_time->getTimestamp() . "_" . $image["name"];
    move_uploaded_file($image["tmp_name"], __DIR__ . "/../assets/$image_name");

    $stmt = $db->prepare("UPDATE animals SET name = ?, diet_type = ?, short_description = ?, id_habitat = ?, image = ?, species = ? WHERE id = ?");
    $status = $stmt->execute([$name, $diet_type, $short_description, $id_habitat, $image_name, $species, $id]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /../src/admin_dashboard.php");
exit();