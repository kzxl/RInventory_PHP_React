<?php
namespace App\DTO;
class BaseCustomer extends BaseDTO
{
    public $id, $full_name, $address, $phone, $identity_number, $issued_date, $issued_place, $create_at, $update_at;
    protected array $hiddenFields=[];
}
class CustomerDTO extends BaseCustomer{
    
}