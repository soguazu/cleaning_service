<?php

namespace Application\Service;

use Application\Entity\ServiceRate;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceRateService extends BaseService
{


    public function createServiceRate()
    {
        try {
            $service_rate = new ServiceRate();
            $ok = $service_rate->save($this->params);

            if ($ok) return "Created service rate successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }

    

    public function getAllServiceRates()
    {
        return ServiceRate::findAll();
    }
}
