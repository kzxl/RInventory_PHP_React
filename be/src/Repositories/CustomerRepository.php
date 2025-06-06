<?php
namespace App\Repositories;

use PDO;
class CustomerRepository extends BaseRepository {   
    protected string $table = 'tbcat_customer';
    protected array $fields = ['full_name', 'address', 'phone', 'identity_number', 'issued_date', 'issued_place'];

    public function __construct(PDO $pdo) {
        parent::__construct($pdo);        
    }

}