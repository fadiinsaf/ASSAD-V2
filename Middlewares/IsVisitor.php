<?php
class IsVisitor
{
        public static function handle(){
        if ($_SESSION["user"]->getUserRole() !== "visiter") {
            Auth::RedirectPath($_SESSION["user"]);
        }
    }

}