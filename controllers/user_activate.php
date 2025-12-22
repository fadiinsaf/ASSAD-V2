<?php
    require_once __DIR__ . "/../database/database.php";

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $id = (int) $_POST["id"];
        $sts = $_POST["status"];

        $stmt = $db->prepare("UPDATE users SET is_active = ? WHERE id = ?");
        $status;

        if($sts){
            $status = $stmt->execute([0 , $id]);
        }
        else{
            $status = $stmt->execute([1 , $id]);
        }

        if($status){
            header("Location: /../src/admin_dashboard.php");
            exit();
        }

        echo "Error";
        die();
    }


    header("Location: /../src/admin_dashboard.php");
    exit();
?>