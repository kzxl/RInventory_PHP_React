<?php
namespace App\Controllers\Customer;

use App\Controllers\BaseResourceController;
use App\Services\Customer\CustomerService;

class CustomerController extends BaseResourceController
{   
    public function __construct(CustomerService $service){
        parent::__construct($service);
    }
}