<?php
namespace App\DTO;
class BaseUser extends BaseDTO{
    public $id, $name, $email, $phone, $password_hash, $is_active;
    protected array $hiddenFields = ['password_hash'];
   
}
class UserDTO extends BaseUser {
    
}

