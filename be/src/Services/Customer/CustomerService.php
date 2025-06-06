<?php
namespace App\Services\Customer;

use App\Repositories\CustomerRepository;
use App\Services\BaseService;

class CustomerService extends BaseService {
    public function __construct(CustomerRepository $repo) {
        parent::__construct($repo);
    }
}