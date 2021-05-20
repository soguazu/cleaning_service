<?php

namespace Application\Service;

use Application\Entity\Customer;
use Application\config\MysqlDBAdapter;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;
use Application\Exception\BadRequestException;
use Application\Exception\InternalServerException;


class CustomerService extends BaseService
{
    public $database;

    public function createCustomer()
    {
        try {
            $this->database = new MysqlDBAdapter();
            $connection = $this->database->getConnection();
            $sql = 'INSERT INTO customers(name, email, address, phone) VALUES(:name, )'
            // if ($response) return "Created customer successfully";

            // http_response_code(ResponseCode::BAD_REQUEST);
            // die("Bad request");
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }
   
}
