<?php 
require_once __DIR__ . "/../Models/User.php";

class Admin extends User
{
    public function __construct(int $id,string $name, string $email, string  $password, string $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function __toString(): string
    {
        return "Admin[id={$this->getUserId()}, name={$this->getUserName()}]";
    }
}