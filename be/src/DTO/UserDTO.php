<?php
namespace App\DTO;

class UserDTO {
    public $id;
    public $name;
    public $email;
     public $password_hash;

    public function __construct($id, $name, $email, $password_hash) {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
        $this->password_hash=$password_hash;
    }
}
