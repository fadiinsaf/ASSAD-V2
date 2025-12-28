<?php
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Reservation.php";
require_once __DIR__ . "/../Models/Visitor.php";
session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $members = (int) $_POST["members"];
    $visit_id = (int) $_POST["visit_id"];

    if(Reservation::createReservation( $members, $_SESSION["user"]->getUserId() , $visit_id )){
        header("Location: /Views/visit_details.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /Views/visit_details.php");
exit();