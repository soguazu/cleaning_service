<?php

namespace Application\Service;

use Application\Entity\Customer;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class CustomerService extends BaseService
{
    public function createCustomer()
    {
        try {
            $customer = new Customer();
            $ok = $customer->save($this->params);
            
            if ($ok) return "Created company successfully";
            
            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getCustomerById()
    {
        try {
            
            return Customer::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }
    public function getAllCustomers()
    {
        return Customer::findAll();
    }
    
}
