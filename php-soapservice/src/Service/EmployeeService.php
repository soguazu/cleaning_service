<?php

namespace Application\Service;

use Application\Entity\Employee;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class EmployeeService extends BaseService
{
    public function createEmployee()
    {
        try {
            $employee = new Employee();
            $ok = $employee->save($this->params);

            if ($ok) return "Created employee successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            die("Bad request");
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getEmployeeById()
    {
        try {
            
            return Employee::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }
    public function getAllEmployees()
    {
        return Employee::findAll();
    }
    
}
