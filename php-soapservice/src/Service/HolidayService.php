<?php

namespace Application\Service;

use Application\Entity\Holiday;
use Application\Entity\InternalServerException;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class HolidayService extends BaseService
{
    public function createHoliday()
    {
        try {
            $holiday = new Holiday();
            $ok = $holiday->save($this->params);

            if ($ok) return "Created holiday successfully";

            http_response_code(ResponseCode::BAD_REQUEST);
            die("Bad request");
            
        } catch (InternalServerException $e) {
            http_response_code(ResponseCode::INTERNAL_SERVER);
            die($e->getMessage());
        }
    }
    
}
