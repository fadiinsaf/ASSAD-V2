<?php

require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id = $_POST["id"];

    $stmt = $db->prepare("SELECT IMAGE FROM animals WHERE id = ?");
    $stmt->execute([$id]);

    $image = $stmt->fetchColumn();

    unlink(__DIR__ . "/../assets/$image");

    $stmt = $db->prepare("DELETE FROM animals WHERE id = ?");
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