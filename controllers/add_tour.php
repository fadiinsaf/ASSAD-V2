<?php
session_start();
require_once __DIR__ . "/../database/database.php";

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $tour_title = $_POST["tour_title"];
    $tour_date = $_POST["tour_date"];
    $tour_duration = $_POST["tour_duration"];
    $tour_lang = $_POST["tour_lang"];
    $tour_cap = $_POST["tour_cap"];
    $tour_price = $_POST["tour_price"];
    $tour_desc = $_POST["tour_desc"];
    $step_titles = $_POST["step_title"];
    $step_orders = $_POST["step_order"];
    $step_descs = $_POST["step_desc"];

    $stmt = $db->prepare("INSERT INTO guide_visits (title, description, start_datetime, duration, price, language, capacity_max, id_guide) VALUES(?,?,?,?,?,?,?,?)");
    $status = $stmt->execute([$tour_title, $tour_desc, $tour_date, $tour_duration, $tour_price, $tour_lang, $tour_cap, $_SESSION["user_id"]]);
    $tour_id = $db->lastInsertId();

    for($i = 0; $i < count($step_titles); $i++){
        $stmt = $db->prepare("INSERT INTO visit_steps (title, description, step_order, id_visit) VALUES(?,?,?,?)");
        $status = $stmt->execute([$step_titles[$i], $step_descs[$i], $step_orders[$i], $tour_id]);
    }
    
    if($status){
        header("Location: /src/guider_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /src/guider_dashboard.php");
exit();