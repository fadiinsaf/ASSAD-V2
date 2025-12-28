<?php

class IsAdmin{
    public static function handle(){
        if ($_SESSION["user"]->getUserRole() !== "admin") {
            Auth::RedirectPath($_SESSION["user"]);
        }
    }
}