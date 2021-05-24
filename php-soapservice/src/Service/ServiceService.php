<?php

namespace Application\Service;

use Application\Entity\Service;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceService extends BaseService
{

    public function createService()
    {
        try {
            $service = new Service();
            $ok = $service->save($this->params);

            if ($ok) return "Created service successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getAllServices()
    {
        return Service::findAll();
    }
}
