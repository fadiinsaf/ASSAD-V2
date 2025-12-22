<?php
session_start();
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $members = (int) $_POST["members"];
    $tour_id = $db->lastInsertId();


    $stmt = $db->prepare("INSERT INTO reservation (number_of_people, id_visiter) VALUES(?,?)");
    $status = $stmt->execute([$members,$_SESSION["user_id"]]);
    
    if($status){
        header("Location: /src/visit_details.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /src/visit_details.php");
exit();