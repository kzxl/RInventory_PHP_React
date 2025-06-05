<?php
namespace App\DTO;
class BaseUser{
    public $id;
    public $name;
    public $email;
    public $phone;
    public $password_hash;
    public $is_active;
    public function __construct($id, $name, $email,$phone, $password_hash, $is_active) {
        $this->id    = $id;
        $this->name  = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->password_hash=$password_hash;
        $this->is_active = $is_active;
    }
}
class UserDTO extends BaseUser {
    public function __construct($id, $name, $email, $phone, $password_hash, $is_active) {
        // Gọi constructor của lớp cha
        parent::__construct( $id,$name, $email, $phone, $password_hash, $is_active );
        
    }
}

