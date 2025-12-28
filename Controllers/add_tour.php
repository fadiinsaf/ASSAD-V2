<?php
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/GuideVisit.php";
require_once __DIR__ . "/../Models/Guide.php";
require_once __DIR__ . "/../Models/VisitStep.php";
session_start();

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

    $last_id = GuideVisit::createVisit($tour_title, $tour_desc, $tour_date, $tour_duration, $tour_price, $tour_lang, $tour_cap,$_SESSION["user"]->getUserId());
    
    if(VisitStep::createVisitStep($step_titles, $step_descs, $step_orders,$last_id)){
        header("Location: /Views/guider_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /Views/guider_dashboard.php");
exit();