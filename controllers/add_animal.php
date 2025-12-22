<?php

require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $diet_type = $_POST["diet_type"];
    $idhab = $_POST["id"];
    $species = $_POST["species"];
    $description = $_POST["short_description"];
    $image = $_FILES["image"];
    $current_time = new DateTime();
    $image_name =  $current_time->getTimestamp() . "_" . $image["name"];
    move_uploaded_file($image["tmp_name"], __DIR__ . "/../assets/$image_name");

    $stmt = $db->prepare("INSERT INTO animals(name, species, diet_type, image, short_description, id_habitat) VALUES(?,?,?,?,?,?)");
    $status = $stmt->execute([$name, $species, $diet_type, $image_name, $description, $idhab]);

    if($status){
        header("Location: /../src/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

        header("Location: /../src/admin_dashboard.php");
exit();