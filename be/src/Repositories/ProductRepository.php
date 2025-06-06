<?php
namespace App\Repositories;

use PDO;
class ProductRepository extends BaseRepository {   
    protected string $table = 'tbcat_product';
    protected array $fields = ['product_id', 'product_name'];

    public function __construct(PDO $pdo) {
        parent::__construct($pdo);        
    }

}