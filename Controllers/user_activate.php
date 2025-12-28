<?php
    require_once __DIR__ . "/../database/database.php";
    require_once __DIR__ . "/../Models/Visitor.php";
    require_once __DIR__ . "/../Models/User.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $id = (int) $_POST["id"];
        $sts = $_POST["status"];
        
        if(Visitor::userActivation($sts,$id)){
            header("Location: /../Views/admin_dashboard.php");
            exit();
        }

        echo "Error";
        die();
    }


    header("Location: /../Views/admin_dashboard.php");
    exit();
?>