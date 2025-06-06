<?php
namespace App\Repositories;

use PDO;
class CustomerRepository extends BaseRepository {   
    public function __construct(PDO $pdo) {
        parent::__construct($pdo);
        $this->table = 'tbcat_customer';
        $this->fields = [ 'full_name', '$address', 'phone', 'identity_number','issued_date', 'issued_place'];
    }

}