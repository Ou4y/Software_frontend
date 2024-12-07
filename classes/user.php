<?php
 abstract class user{
    public int $id;
    public string $name;
    public string $email;
    public string $password;
    public int $phone;
    public bool $type;

    public function __construct() {
       
    }


}

?>