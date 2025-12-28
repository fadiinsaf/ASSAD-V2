<?php
require_once __DIR__ . "/../database/database.php";
require_once __DIR__ . "/../Models/Habitat.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $zoo_zone = $_POST["zoo_zone"];
    $description = $_POST["description"];

    if (Habitat::updateHabitat($name, $description, $zoo_zone, $id)) {
        header("Location: /../Views/admin_dashboard.php");
        exit();
    }

    echo "Error";
    die();
}

header("Location: /../Views/admin_dashboard.php");

exit();
