<?php
namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Services\BaseService;

class ProductService extends BaseService {
    public function __construct(ProductRepository $repo) {
        parent::__construct($repo);
    }
}