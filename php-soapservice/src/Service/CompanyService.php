<?php

namespace Application\Service;

use Application\Entity\Company;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class CompanyService extends BaseService
{

    public function helloFromPHP()
    {
        return [
            'message' => 'Hello from devs @ 10HL'
        ];
    }

    public function createCompany()
    {
        try {
            $company = new Company();
            $ok = $company->save($this->params);

            if ($ok) return "Created company successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            die("Bad request");
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getCompanyById()
    {
        try {
            // $company = new Company();
            // return $this->company->find($this->params['id']);
            
            return Company::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }

    public function getAllCompanies()
    {
        return Company::findAll();
    }
}
