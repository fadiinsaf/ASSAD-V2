<?php

class IsAuthed{
    public static function handle(){
        if (!isset($_SESSION["user"])) {
            header("Location: /index.php");
            exit();
        }
    }
}