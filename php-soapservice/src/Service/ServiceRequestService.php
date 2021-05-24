<?php

namespace Application\Service;

use Application\Entity\ServiceRequest;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceRequestService extends BaseService
{
    public function createServiceRequest()
    {
        try {
            $service_request = new ServiceRequest();
            $ok = $service_request->save($this->params);
            
            if ($ok) return "Created Service Request successfully";
            
            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    public function getServiceRequestById()
    {
        try {
            
            return ServiceRequest::find($this->params['id']);
        } catch (RecordNotFoundException $e) {
            http_response_code(ResponseCode::NOT_FOUND);
            die($e->getMessage());
        }
    }
    public function getAllServiceRequests()
    {
        return ServiceRequest::findAll();
    }
    
}
