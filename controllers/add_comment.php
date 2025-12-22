<?php
session_start();
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $id_visit = $_POST["visit_id"];
    $rating = (int)$_POST["rating"];
    $comment_text = $_POST["comment_text"];

    $stmt = $db->prepare("INSERT INTO comments (comment_text,rating,id_visiter,id_visit) VALUES(?,?,?,?)");
    $status = $stmt->execute([$comment_text , $rating, $_SESSION["user_id"], $id_visit]);
    
    if($status){
        header("Location: /src/visit_details.php");
        exit();
    }

    echo "Error";
    die();
}

    header("Location: /src/visit_details.php");
    exit();