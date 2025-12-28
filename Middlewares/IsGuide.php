<?php 
class IsGuide
{
    public static function handle(){
        if ($_SESSION["user"]->getUserRole() !== "guide") {
            Auth::RedirectPath($_SESSION["user"]);
        }
    }
}