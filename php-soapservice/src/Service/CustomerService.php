<?php

namespace Application\Service;

use Application\Entity\Customer;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class CustomerService extends BaseService
{
    public function createCustomer()
    {
        try {
            $customer = new Customer();
            return $customer->save($this->params);
            
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }
    
}
